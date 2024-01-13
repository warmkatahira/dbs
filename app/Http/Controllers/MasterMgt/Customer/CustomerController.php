<?php

namespace App\Http\Controllers\MasterMgt\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\MasterMgt\Customer\CustomerService;
use App\Services\MasterMgt\Customer\CustomerSyncService;
use App\Services\MasterMgt\Customer\CustomerDownloadService;
// その他
use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;

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
        return view('master_mgt.customer.index')->with([
            'bases' => $bases,
            'customers' => $customers,
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
}
