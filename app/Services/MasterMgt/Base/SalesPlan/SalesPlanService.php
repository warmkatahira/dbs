<?php

namespace App\Services\MasterMgt\Base\SalesPlan;

// モデル
use App\Models\SalesPlan;
// その他
use Carbon\CarbonImmutable;

class SalesPlanService
{
    // 検索条件のセッションを削除
    public function deleteSearchSession()
    {
        session()->forget([
            'search_sales_plan_ym_from',
            'search_sales_plan_ym_to',
        ]);
        return;
    }

    // 検索条件の初期条件をセット
    public function setDefaultCondition($search_enter)
    {
        // nullなら検索が実行されていないので、初期条件をセット
        if(is_null($search_enter)){
            session(['search_sales_plan_ym_from' => CarbonImmutable::now()->format('Y-m')]);
            session(['search_sales_plan_ym_to' => CarbonImmutable::now()->format('Y-m')]);
        }
        return;
    }

    // 検索条件をセッションにセット
    public function setSearchCondition($request)
    {
        // trueなら検索が実行されているので、検索条件をセット(nullなら今月をセット)
        if($request->search_enter){
            session(['search_sales_plan_ym_from' => is_null($request->search_sales_plan_ym_from) ? CarbonImmutable::now()->format('Y-m') : $request->search_sales_plan_ym_from]);
            session(['search_sales_plan_ym_to' => is_null($request->search_sales_plan_ym_to) ? CarbonImmutable::now()->format('Y-m') : $request->search_sales_plan_ym_to]);
        }
        return;
    }

    // 売上計画情報を取得
    public function getSalesPlanSearch($request)
    {
        // 現在のURLを取得
        session(['back_url_1' => url()->full()]);
        // 売上計画を拠点で抽出
        $sales_plans = SalesPlan::where('base_id', session('search_base_id'));
        // 売上計画年月条件がある場合
        if(!empty(session('search_sales_plan_ym_from')) && !empty(session('search_sales_plan_ym_to'))){
            $from = CarbonImmutable::createFromFormat('Y-m', session('search_sales_plan_ym_from'))->startOfMonth();
            $to = CarbonImmutable::createFromFormat('Y-m', session('search_sales_plan_ym_to'))->endOfMonth();
            $sales_plans->whereDate('sales_plan_ym', '>=', $from)->whereDate('sales_plan_ym', '<=', $to);
        }
        // 売上計画年月で並び替え
        return $sales_plans->orderBy('sales_plan_ym', 'asc')->paginate(50);
    }
}