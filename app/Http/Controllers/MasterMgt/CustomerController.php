<?php

namespace App\Http\Controllers\MasterMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\MasterMgt\Customer\CustomerService;
use App\Services\MasterMgt\Customer\CustomerSyncService;
// その他
use Illuminate\Support\Facades\DB;

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
        $customers = $CustomerSerivce->getCustomerSearch($request);
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
        // DB:kintaiのbasesテーブルと同期
        $CustomerSyncSerivce->syncBase();
        // DB:kintaiのcustomersテーブルと同期
        $CustomerSyncSerivce->syncCustomer();
        return back();
    }
}
