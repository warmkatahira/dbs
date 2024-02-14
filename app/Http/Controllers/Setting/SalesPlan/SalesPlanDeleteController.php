<?php

namespace App\Http\Controllers\Setting\SalesPlanSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\SalesPlanSetting;
// サービス
use App\Services\SalesPlanSetting\SalesPlanSettingDeleteService;

class SalesPlanSettingDeleteController extends Controller
{
    public function delete(Request $request)
    {
        // インスタンス化
        $SalesPlanSettingDeleteService = new SalesPlanSettingDeleteService;
        // 売上計画を削除
        $SalesPlanSettingDeleteService->deleteSalesPlanSetting($request->sales_plan_setting_id);
        return back()->with([
            'alert_type' => 'success',
            'alert_message' => '売上計画の削除が完了しました。',
        ]);
    }
}
