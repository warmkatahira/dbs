<?php

namespace App\Http\Controllers\MonthlyCost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\MonthlyCost\MonthlyCostService;

class MonthlyCostController extends Controller
{
    public function index(Request $request)
    {
        // 拠点IDをセッションにセット
        session(['search_base_id' => $request->base_id]);
        // インスタンス化
        $MonthlyCostSerivce = new MonthlyCostService;
        // 検索条件のセッションを削除
        $MonthlyCostSerivce->deleteSearchSession();
        // 検索条件の初期条件をセット
        $MonthlyCostSerivce->setDefaultCondition($request->search_enter);
        // 検索条件をセッションにセット
        $MonthlyCostSerivce->setSearchCondition($request);
        // 月額経費情報を取得
        $monthly_costs = $MonthlyCostSerivce->getMonthlyCostSearch($request);
        // 拠点を取得
        $bases = Base::getall()->get();
        return view('monthly_cost.index')->with([
            'monthly_costs' => $monthly_costs,
            'bases' => $bases,
        ]);
    }
}
