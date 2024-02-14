<?php

namespace App\Http\Controllers\Setting\MonthlyCostSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\MonthlyCostSetting;
// サービス
use App\Services\MonthlyCostSetting\MonthlyCostSettingDeleteService;

class MonthlyCostSettingDeleteController extends Controller
{
    public function delete(Request $request)
    {
        // インスタンス化
        $MonthlyCostSettingDeleteService = new MonthlyCostSettingDeleteService;
        // 月額経費を削除
        $MonthlyCostSettingDeleteService->deleteMonthlyCostSetting($request->monthly_cost_setting_id);
        return back()->with([
            'alert_type' => 'success',
            'alert_message' => '月額経費の削除が完了しました。',
        ]);
    }
}
