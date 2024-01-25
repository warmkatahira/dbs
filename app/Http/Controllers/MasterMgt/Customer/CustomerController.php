<?php

namespace App\Http\Controllers\MasterMgt\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
use App\Models\Customer;
// サービス
use App\Services\MasterMgt\Customer\CustomerService;
use App\Services\MasterMgt\Customer\CustomerSyncService;
use App\Services\MasterMgt\Customer\CustomerDownloadService;
use App\Services\MasterMgt\Customer\CustomerUploadService;
use App\Services\MasterMgt\Customer\CustomerUploadErrorDownloadSerivce;
// その他
use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Enums\BooleanEnum;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // インスタンス化
        $CustomerSerivce = new CustomerService;
        // 検索条件のセッションを削除
        $CustomerSerivce->deleteSearchSession();
        // 検索条件の初期条件をセット
        $CustomerSerivce->setDefaultCondition($request->search_enter);
        // 検索条件をセッションにセット
        $CustomerSerivce->setSearchCondition($request);
        // 荷主情報を取得
        $customers = $CustomerSerivce->getCustomerSearch()->paginate(50);
        // 拠点を全て取得
        $bases = Base::getAll()->get();
        // 拠点条件がある場合、経費分配割合を合計し100%であるか確認
        $cost_allocation_ratio_check = $CustomerSerivce->checkCostAllocationRatio();
        // 有効/無効の検索条件に使用する情報を作成
        $is_available_conditions = BooleanEnum::makeCondition();
        return view('master_mgt.customer.index')->with([
            'bases' => $bases,
            'customers' => $customers,
            'cost_allocation_ratio_check' => $cost_allocation_ratio_check,
            'is_available_conditions' => $is_available_conditions,
        ]);
    }

    public function sync()
    {
        // インスタンス化
        $CustomerSyncSerivce = new CustomerSyncService;
        // DB:kintaiのcustomersテーブルと同期
        $CustomerSyncSerivce->syncCustomer();
        return back()->with([
            'alert_type' => 'success',
            'alert_message' => '荷主同期が完了しました。',
        ]);
    }

    public function download()
    {
        // インスタンス化
        $CustomerSerivce = new CustomerService;
        $CustomerDownloadSerivce = new CustomerDownloadService;
        // 荷主情報を取得
        $customers = $CustomerSerivce->getCustomerSearch();
        // ダウンロードするデータを取得
        $response = $CustomerDownloadSerivce->getDownloadCustomer($customers);
        // ダウンロード処理
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename=荷主マスタ_' . CarbonImmutable::now()->isoFormat('Y年MM月DD日HH時mm分ss秒') . '.csv');
        return $response;
    }

    public function upload(Request $request)
    {
        // アップロードエラーを格納しているセッションを削除
        session()->forget(['customer_upload_error']);
        // インスタンス化
        $CustomerUploadService = new CustomerUploadService;
        try {
            $result = DB::transaction(function () use ($request, $CustomerUploadService) {
                // 現在の日時を取得
                $nowDate = CarbonImmutable::now();
                // 拡張子がCSVであるかの確認
                if ($request->csvFile->getClientOriginalExtension() !== "csv") {
                    throw new \Exception('拡張子がCSVではありません。');
                }
                // ストレージに保存する際のファイル名を指定(customer_import_ユーザーID_現在日時.csv)
                $store_file_name = 'customer_import_'.Auth::user()->user_id.'_'.CarbonImmutable::now()->isoFormat('YMMDDHHmmss').'.csv';
                // 選択したファイルをストレージに保存
                $path = $CustomerUploadService->storeFile($request->file('csvFile'), $store_file_name);
                // 保存したCSVファイルのデータを取得
                $csv = File::get(storage_path('app/' . $path));
                // 文字コードをUTF-8に変換
                $csv = mb_convert_encoding($csv, 'UTF-8', 'ASCII, JIS, UTF-8, SJIS-win');
                // BOMを削除する
                $csv = str_replace("\u{FEFF}", "", $csv);
                // 改行コードに「CRLF」又は「CR」が存在している場合
                if (strpos($csv, "\r") !== false) {
                    // 「LF」との混在の可能性があるので、「LF」を削除する
                    $csv = str_replace("\n", "", $csv);
                    // 改行コードを「LF」に統一するので、「CRLF」と「CR」を「LF」に置換する
                    $csv = str_replace(array("\r\n", "\r"), "\n", $csv);
                }
                // $csvを元に行単位のコレクションを作成し、改行コードだけの要素を削除
                $csv_records = collect(explode("\n", $csv))->filter(function ($item) {
                    return !empty(trim($item));
                });
                // システムに定義してあるヘッダーを取得
                $header = Customer::csvHeader();
                // CSVからヘッダーを取得(shiftメソッドにより、最初の要素が取り除かれるので、ヘッダーがコレクションから無くなる)
                $csvHeader = explode(",", $csv_records->shift());
                // ヘッダーを比較し、差分があればエラー情報を返す
                if (!empty(array_diff_assoc($header, $csvHeader))) {
                    return '受注データのヘッダーに相違がある為、インポートできませんでした。';
                }
                // ヘッダーをコレクションに変換
                $header = collect(Customer::csvHeader_EN());
                // ヘッダーをキーにした連想配列のコレクションを作成
                $items = $csv_records->map(fn($oneRecord) => $header->combine(collect(str_getcsv($oneRecord))));
                // テーブルにアップロードしたデータを更新
                $validation_error = $CustomerUploadService->updateCustomer($items);
                // バリデーションエラー配列の中にnull以外があれば、処理を中断
                if (count(array_filter($validation_error)) != 0) {
                    // セッションにエラー情報を格納
                    session(['customer_upload_error' => array(['エラー情報' => $validation_error, 'アップロード日時' => $nowDate])]);
                    throw new \Exception("データが正しくない為、アップロードできませんでした。<br/>詳細はアップロードエラーを確認して下さい。");
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'alert_type' => 'error',
                'alert_message' => $e->getMessage(),
            ]);
        }
        return redirect()->back()->with([
            'alert_type' => 'success',
            'alert_message' => '荷主マスタをアップロードしました。',
        ]);
    }

    public function upload_error_download()
    {
        // インスタンス化
        $CustomerUploadErrorDownloadSerivce = new CustomerUploadErrorDownloadSerivce;
        // ダウンロードするデータを取得
        $response = $CustomerUploadErrorDownloadSerivce->getDownloadCustomerUploadError(session('customer_upload_error')[0]['エラー情報']);
        // ダウンロード処理
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename=荷主マスタアップロードエラー'.CarbonImmutable::now()->isoFormat('Y年MM月DD日HH時mm分ss秒') . '.csv');
        return $response;
    }
}
