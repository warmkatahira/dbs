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
// その他
use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;
use App\Enums\BooleanEnum;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // インスタンス化
        $CustomerService = new CustomerService;
        // 検索条件のセッションを削除
        $CustomerService->deleteSearchSession();
        // 検索条件の初期条件をセット
        $CustomerService->setDefaultCondition($request->search_enter);
        // 検索条件をセッションにセット
        $CustomerService->setSearchCondition($request);
        // 荷主情報を取得
        $customers = $CustomerService->getCustomerSearch()->paginate(50);
        // 拠点を全て取得
        $bases = Base::getAll()->get();
        // 有効/無効の検索条件に使用する情報を作成
        $is_available_conditions = BooleanEnum::makeCondition();
        return view('master_mgt.customer.index')->with([
            'bases' => $bases,
            'customers' => $customers,
            'is_available_conditions' => $is_available_conditions,
        ]);
    }

    public function sync()
    {
        // インスタンス化
        $CustomerSyncService = new CustomerSyncService;
        // DB:kintaiのcustomersテーブルと同期
        $CustomerSyncService->syncCustomer();
        return back()->with([
            'alert_type' => 'success',
            'alert_message' => '荷主同期が完了しました。',
        ]);
    }

    public function download()
    {
        // インスタンス化
        $CustomerService = new CustomerService;
        $CustomerDownloadService = new CustomerDownloadService;
        // 荷主情報を取得
        $customers = $CustomerService->getCustomerSearch();
        // ダウンロードするデータを取得
        $response = $CustomerDownloadService->getDownloadCustomer($customers);
        // ダウンロード処理
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename=荷主マスタ_' . CarbonImmutable::now()->isoFormat('Y年MM月DD日HH時mm分ss秒') . '.csv');
        return $response;
    }
}
