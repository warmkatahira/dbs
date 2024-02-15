<?php

namespace App\Services\Setting\MonthlyCustomerSetting;

// モデル
use App\Models\MonthlyCustomerSetting;
// その他
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonImmutable;

class MonthlyCustomerSettingService
{
    // 検索条件のセッションを削除
    public function deleteSearchSession()
    {
        session()->forget([
            'search_base_id',
            'search_monthly_customer_setting_ym_from',
            'search_monthly_customer_setting_ym_to',
            'search_customer_name',
        ]);
        return;
    }

    // 検索条件の初期条件をセット
    public function setDefaultCondition($search_enter)
    {
        // nullなら検索が実行されていないので、初期条件をセット
        if(is_null($search_enter)){
            session(['search_base_id' => Auth::user()->base_id]);
            session(['search_monthly_customer_setting_ym_from' => CarbonImmutable::now()->format('Y-m')]);
            session(['search_monthly_customer_setting_ym_to' => CarbonImmutable::now()->format('Y-m')]);
        }
        return;
    }

    // 検索条件をセッションにセット
    public function setSearchCondition($request)
    {
        // trueなら検索が実行されているので、検索条件をセット
        if($request->search_enter){
            session(['search_base_id' => $request->search_base_id]);
            session(['search_monthly_customer_setting_ym_from' => is_null($request->search_monthly_customer_setting_ym_from) ? CarbonImmutable::now()->format('Y-m') : $request->search_monthly_customer_setting_ym_from]);
            session(['search_monthly_customer_setting_ym_to' => is_null($request->search_monthly_customer_setting_ym_to) ? CarbonImmutable::now()->format('Y-m') : $request->search_monthly_customer_setting_ym_to]);
            session(['search_customer_name' => $request->search_customer_name]);
        }
        return;
    }

    // 月額荷主設定情報を取得
    public function getMonthlyCustomerSettingSearch()
    {
        // 現在のURLを取得
        session(['back_url_1' => url()->full()]);
        // 月額荷主設定をセット
        $monthly_customer_settings = MonthlyCustomerSetting::query();
        // 拠点条件がある場合
        if(session('search_base_id') != null){
            $monthly_customer_settings->whereHas('dbs_customer.dbs_base', function ($monthly_customer_settings) {
                $monthly_customer_settings->where('base_id', session('search_base_id'));
            });
        }
        // 月額荷主設定年月条件がある場合
        if(!empty(session('search_monthly_customer_setting_ym_from')) && !empty(session('search_monthly_customer_setting_ym_to'))){
            $from = CarbonImmutable::createFromFormat('Y-m', session('search_monthly_customer_setting_ym_from'))->startOfMonth();
            $to = CarbonImmutable::createFromFormat('Y-m', session('search_monthly_customer_setting_ym_to'))->endOfMonth();
            $monthly_customer_settings->whereDate('monthly_customer_setting_ym', '>=', $from)->whereDate('monthly_customer_setting_ym', '<=', $to);
        }
        // 荷主名条件がある場合
        if(session('search_customer_name') != null){
            $monthly_customer_settings->where('customer_name', 'LIKE', '%'.session('search_customer_name').'%');
        }
        // 拠点IDと荷主IDで並び替え
        return $monthly_customer_settings->whereHas('dbs_customer.dbs_base', function ($monthly_customer_settings) {
                    $monthly_customer_settings->orderBy('base_id', 'asc');
                })
                ->orderBy('monthly_customer_setting_ym', 'asc')
                ->whereHas('dbs_customer.dbs_base', function ($monthly_customer_settings) {
                    $monthly_customer_settings->orderBy('customer_sort_order', 'asc');
                });
    }

    // 拠点条件がある場合、経費分配割合を合計し100%であるか確認
    public function checkCostAllocationRatio()
    {
        // 変数を初期化
        $ho_cost = '';
        $monthly_cost_setting = '';
        // 拠点条件があって、月額荷主設定年月条件が単月である場合
        if(session('search_base_id') != null && session('search_monthly_customer_setting_ym_from') == session('search_monthly_customer_setting_ym_to')){
            // 指定された拠点で荷主が有効なものを対象に経費分配割合の合計を取得
            $total_ho_cost_allocation_ratio = MonthlyCustomerSetting::getTotalCostAllocationRatio(session('search_base_id'), CarbonImmutable::createFromFormat('Y-m', session('search_monthly_customer_setting_ym_from'))->startOfMonth(), 'ho_cost_allocation_ratio');
            $total_monthly_cost_allocation_ratio = MonthlyCustomerSetting::getTotalCostAllocationRatio(session('search_base_id'), CarbonImmutable::createFromFormat('Y-m', session('search_monthly_customer_setting_ym_from'))->startOfMonth(), 'monthly_cost_allocation_ratio');
            // 合計が100以外だったら、エラーメッセージをセット
            if($total_ho_cost_allocation_ratio != 100){
                $ho_cost = '「本社管理費分配割合」の合計が100%ではありません。(現在：'.$total_ho_cost_allocation_ratio.'%)';
            }
            if($total_monthly_cost_allocation_ratio != 100){
                $monthly_cost_setting = '「月額経費分配割合」の合計が100%ではありません。(現在：'.$total_monthly_cost_allocation_ratio.'%)';
            }
        }
        return compact('ho_cost', 'monthly_cost_setting');
    }
}