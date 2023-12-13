<?php

namespace App\Http\Controllers\SalesPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\SalesPlan\SalesPlanService;

class SalesPlanController extends Controller
{
    public function index(Request $request)
    {
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
        $bases = Base::getall()->get();
        return view('sales_plan.index')->with([
            'sales_plans' => $sales_plans,
            'bases' => $bases,
        ]);
    }
}
