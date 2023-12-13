<?php

namespace App\Services\MasterMgt\Base\MonthlyCost;

// モデル
use App\Models\MonthlyCost;
// その他
use Carbon\CarbonImmutable;

class MonthlyCostService
{
    // 検索条件のセッションを削除
    public function deleteSearchSession()
    {
        session()->forget([
            'search_monthly_cost_ym_from',
            'search_monthly_cost_ym_to',
        ]);
        return;
    }

    // 検索条件の初期条件をセット
    public function setDefaultCondition($search_enter)
    {
        // nullなら検索が実行されていないので、初期条件をセット
        if(is_null($search_enter)){
            session(['search_monthly_cost_ym_from' => CarbonImmutable::now()->format('Y-m')]);
            session(['search_monthly_cost_ym_to' => CarbonImmutable::now()->format('Y-m')]);
        }
        return;
    }

    // 検索条件をセッションにセット
    public function setSearchCondition($request)
    {
        // trueなら検索が実行されているので、検索条件をセット(nullなら今月をセット)
        if($request->search_enter){
            session(['search_monthly_cost_ym_from' => is_null($request->search_monthly_cost_ym_from) ? CarbonImmutable::now()->format('Y-m') : $request->search_monthly_cost_ym_from]);
            session(['search_monthly_cost_ym_to' => is_null($request->search_monthly_cost_ym_to) ? CarbonImmutable::now()->format('Y-m') : $request->search_monthly_cost_ym_to]);
        }
        return;
    }

    // 月額経費情報を取得
    public function getMonthlyCostSearch($request)
    {
        // 現在のURLを取得
        session(['back_url_1' => url()->full()]);
        // 月額経費を拠点で抽出
        $monthly_costs = MonthlyCost::where('base_id', session('search_base_id'));
        // 月額経費年月条件がある場合
        if(!empty(session('search_monthly_cost_ym_from')) && !empty(session('search_monthly_cost_ym_to'))){
            $from = CarbonImmutable::createFromFormat('Y-m', session('search_monthly_cost_ym_from'))->startOfMonth();
            $to = CarbonImmutable::createFromFormat('Y-m', session('search_monthly_cost_ym_to'))->endOfMonth();
            $monthly_costs->whereDate('monthly_cost_ym', '>=', $from)->whereDate('monthly_cost_ym', '<=', $to);
        }
        // 月額経費年月と項目IDで並び替え
        return $monthly_costs->orderBy('monthly_cost_ym', 'asc')->orderBy('monthly_cost_item_id', 'asc')->paginate(50);
    }
}