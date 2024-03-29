<?php

namespace App\Http\Controllers\Setting\MonthlyCostSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\Setting\MonthlyCostSetting\MonthlyCostSettingService;

class MonthlyCostSettingController extends Controller
{
    public function index(Request $request)
    {
        // 拠点IDをセッションにセット
        session(['search_base_id' => $request->base_id]);
        // インスタンス化
        $MonthlyCostSettingService = new MonthlyCostSettingService;
        // 検索条件のセッションを削除
        $MonthlyCostSettingService->deleteSearchSession();
        // 検索条件の初期条件をセット
        $MonthlyCostSettingService->setDefaultCondition($request->search_enter);
        // 検索条件をセッションにセット
        $MonthlyCostSettingService->setSearchCondition($request);
        // 月額経費情報を取得
        $monthly_cost_settings = $MonthlyCostSettingService->getMonthlyCostSettingSearch($request);
        // 拠点を取得
        $bases = Base::getall()->get();
        return view('setting.monthly_cost_setting.index')->with([
            'monthly_cost_settings' => $monthly_cost_settings,
            'bases' => $bases,
        ]);
    }
}
