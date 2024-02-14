<?php

namespace App\Services\MonthlyCostSetting;

// モデル
use App\Models\MonthlyCostSetting;
// その他
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class MonthlyCostSettingService
{
    // 検索条件のセッションを削除
    public function deleteSearchSession()
    {
        session()->forget([
            'search_monthly_cost_setting_ym_from',
            'search_monthly_cost_setting_ym_to',
            'search_base_id',
        ]);
        return;
    }

    // 検索条件の初期条件をセット
    public function setDefaultCondition($search_enter)
    {
        // nullなら検索が実行されていないので、初期条件をセット
        if(is_null($search_enter)){
            session(['search_monthly_cost_setting_ym_from' => CarbonImmutable::now()->format('Y-m')]);
            session(['search_monthly_cost_setting_ym_to' => CarbonImmutable::now()->format('Y-m')]);
            session(['search_base_id' => Auth::user()->base_id]);
        }
        return;
    }

    // 検索条件をセッションにセット
    public function setSearchCondition($request)
    {
        // trueなら検索が実行されているので、検索条件をセット(nullなら今月をセット)
        if($request->search_enter){
            session(['search_monthly_cost_setting_ym_from' => is_null($request->search_monthly_cost_setting_ym_from) ? CarbonImmutable::now()->format('Y-m') : $request->search_monthly_cost_setting_ym_from]);
            session(['search_monthly_cost_setting_ym_to' => is_null($request->search_monthly_cost_setting_ym_to) ? CarbonImmutable::now()->format('Y-m') : $request->search_monthly_cost_setting_ym_to]);
            session(['search_base_id' => $request->search_base_id]);
        }
        return;
    }

    // 月額経費情報を取得
    public function getMonthlyCostSettingSearch($request)
    {
        // 現在のURLを取得
        session(['back_url_1' => url()->full()]);
        // テーブルをセット
        $monthly_cost_settings = MonthlyCostSetting::query();
        // 拠点条件がある場合
        if (session('search_base_id') != null) {
            $monthly_cost_settings->where('base_id', session('search_base_id'));
        }
        // 月額経費年月条件がある場合
        if(!empty(session('search_monthly_cost_setting_ym_from')) && !empty(session('search_monthly_cost_setting_ym_to'))){
            $from = CarbonImmutable::createFromFormat('Y-m', session('search_monthly_cost_setting_ym_from'))->startOfMonth();
            $to = CarbonImmutable::createFromFormat('Y-m', session('search_monthly_cost_setting_ym_to'))->endOfMonth();
            $monthly_cost_settings->whereDate('monthly_cost_setting_ym', '>=', $from)->whereDate('monthly_cost_setting_ym', '<=', $to);
        }
        // 並び替え
        return $monthly_cost_settings
                ->orderBy('base_id', 'asc')
                ->orderBy('monthly_cost_setting_ym', 'asc')
                ->orderBy('monthly_cost_setting_item_id', 'asc')
                ->paginate(50);
    }
}