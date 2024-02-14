<?php

namespace App\Http\Controllers\Setting\SalesPlanSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\SalesPlanSetting;
// サービス
use App\Services\SalesPlanSetting\SalesPlanSettingUpdateService;
// リクエスト
use App\Http\Requests\SalesPlanSetting\SalesPlanSettingUpdateRequest;

class SalesPlanSettingUpdateController extends Controller
{
    public function index(Request $request)
    {
        // 売上計画IDをセッションにセット
        session(['sales_plan_setting_id' => $request->sales_plan_setting_id]);
        // 売上計画を取得
        $sales_plan_setting = SalesPlanSetting::getSpecify($request->sales_plan_setting_id)->first();
        return view('sales_plan_setting.update')->with([
            'sales_plan_setting' => $sales_plan_setting,
        ]);
    }

    public function update(SalesPlanSettingUpdateRequest $request)
    {
        // インスタンス化
        $SalesPlanSettingUpdateService = new SalesPlanSettingUpdateService;
        // 売上計画を更新
        $SalesPlanSettingUpdateService->updateSalesPlanSetting($request);
        return redirect(session('back_url_1'))->with([
            'alert_type' => 'success',
            'alert_message' => '売上計画の更新が完了しました。',
        ]);
    }
}
