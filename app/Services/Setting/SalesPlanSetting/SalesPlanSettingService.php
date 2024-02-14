<?php

namespace App\Services\Setting\SalesPlanSetting;

// モデル
use App\Models\SalesPlanSetting;
// その他
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class SalesPlanSettingService
{
    // 検索条件のセッションを削除
    public function deleteSearchSession()
    {
        session()->forget([
            'search_sales_plan_setting_ym_from',
            'search_sales_plan_setting_ym_to',
            'search_base_id',
        ]);
        return;
    }

    // 検索条件の初期条件をセット
    public function setDefaultCondition($search_enter)
    {
        // nullなら検索が実行されていないので、初期条件をセット
        if(is_null($search_enter)){
            session(['search_sales_plan_setting_ym_from' => CarbonImmutable::now()->format('Y-m')]);
            session(['search_sales_plan_setting_ym_to' => CarbonImmutable::now()->format('Y-m')]);
            session(['search_base_id' => Auth::user()->base_id]);
        }
        return;
    }

    // 検索条件をセッションにセット
    public function setSearchCondition($request)
    {
        // trueなら検索が実行されているので、検索条件をセット(日付に関しては、nullなら今月をセット)
        if($request->search_enter){
            session(['search_sales_plan_setting_ym_from' => is_null($request->search_sales_plan_setting_ym_from) ? CarbonImmutable::now()->format('Y-m') : $request->search_sales_plan_setting_ym_from]);
            session(['search_sales_plan_setting_ym_to' => is_null($request->search_sales_plan_setting_ym_to) ? CarbonImmutable::now()->format('Y-m') : $request->search_sales_plan_setting_ym_to]);
            session(['search_base_id' => $request->search_base_id]);
        }
        return;
    }

    // 売上計画情報を取得
    public function getSalesPlanSettingSearch($request)
    {
        // 現在のURLを取得
        session(['back_url_1' => url()->full()]);
        // テーブルをセット
        $sales_plan_settings = SalesPlanSetting::query();
        // 拠点条件がある場合
        if (session('search_base_id') != null) {
            $sales_plan_settings->where('base_id', session('search_base_id'));
        }
        // 売上計画年月条件がある場合
        if(!empty(session('search_sales_plan_setting_ym_from')) && !empty(session('search_sales_plan_setting_ym_to'))){
            $from = CarbonImmutable::createFromFormat('Y-m', session('search_sales_plan_setting_ym_from'))->startOfMonth();
            $to = CarbonImmutable::createFromFormat('Y-m', session('search_sales_plan_setting_ym_to'))->endOfMonth();
            $sales_plan_settings->whereDate('sales_plan_setting_ym', '>=', $from)->whereDate('sales_plan_setting_ym', '<=', $to);
        }
        // 並び替え
        return $sales_plan_settings
                ->orderBy('base_id', 'asc')
                ->orderBy('sales_plan_setting_ym', 'asc')
                ->paginate(50);
    }
}