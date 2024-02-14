<?php

namespace App\Http\Controllers\Setting\SalesPlanSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\SalesPlanSetting\SalesPlanSettingService;

class SalesPlanSettingController extends Controller
{
    public function index(Request $request)
    {
        // インスタンス化
        $SalesPlanSettingSerivce = new SalesPlanSettingService;
        // 検索条件のセッションを削除
        $SalesPlanSettingSerivce->deleteSearchSession();
        // 検索条件の初期条件をセット
        $SalesPlanSettingSerivce->setDefaultCondition($request->search_enter);
        // 検索条件をセッションにセット
        $SalesPlanSettingSerivce->setSearchCondition($request);
        // 売上計画情報を取得
        $sales_plan_settings = $SalesPlanSettingSerivce->getSalesPlanSettingSearch($request);
        // 拠点を取得
        $bases = Base::getall()->get();
        return view('sales_plan_setting.index')->with([
            'sales_plan_settings' => $sales_plan_settings,
            'bases' => $bases,
        ]);
    }
}
