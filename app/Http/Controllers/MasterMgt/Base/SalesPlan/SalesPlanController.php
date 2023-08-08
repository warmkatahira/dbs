<?php

namespace App\Http\Controllers\MasterMgt\Base\SalesPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
use App\Models\SalesPlan;
// サービス
use App\Services\MasterMgt\Base\SalesPlan\SalesPlanService;
// その他
use Illuminate\Support\Facades\DB;

class SalesPlanController extends Controller
{
    public function index(Request $request)
    {
        // 拠点IDをセッションにセット
        session(['search_base_id' => $request->base_id]);
        // インスタンス化
        $SalesPlanSerivce = new SalesPlanService;
        // 検索条件のセッションを削除
        $SalesPlanSerivce->deleteSearchSession();
        // 検索条件の初期条件をセット
        $SalesPlanSerivce->setDefaultCondition($request->search_enter);
        // 検索条件をセッションにセット
        $SalesPlanSerivce->setSearchCondition($request);
        // 売上計画情報を取得
        $sales_plans = $SalesPlanSerivce->getSalesPlanSearch($request);
        // 拠点を取得
        $base = Base::getSpecify($request->base_id)->first();
        return view('master_mgt.base.sales_plan.index')->with([
            'sales_plans' => $sales_plans,
            'base' => $base,
        ]);
    }
}
