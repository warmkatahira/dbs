<?php

namespace App\Http\Controllers\Setting\SalesPlanSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\Setting\SalesPlanSetting\SalesPlanSettingService;

class SalesPlanSettingController extends Controller
{
    public function index(Request $request)
    {
        // インスタンス化
        $SalesPlanSettingService = new SalesPlanSettingService;
        // 検索条件のセッションを削除
        $SalesPlanSettingService->deleteSearchSession();
        // 検索条件の初期条件をセット
        $SalesPlanSettingService->setDefaultCondition($request->search_enter);
        // 検索条件をセッションにセット
        $SalesPlanSettingService->setSearchCondition($request);
        // 売上計画情報を取得
        $sales_plan_settings = $SalesPlanSettingService->getSalesPlanSettingSearch($request);
        // 拠点を取得
        $bases = Base::getall()->get();
        return view('setting.sales_plan_setting.index')->with([
            'sales_plan_settings' => $sales_plan_settings,
            'bases' => $bases,
        ]);
    }
}
