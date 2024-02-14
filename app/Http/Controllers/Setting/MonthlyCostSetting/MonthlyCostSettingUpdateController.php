<?php

namespace App\Http\Controllers\Setting\MonthlyCostSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\MonthlyCostSetting;
// サービス
use App\Services\Setting\MonthlyCostSetting\MonthlyCostSettingUpdateService;
// リクエスト
use App\Http\Requests\Setting\MonthlyCostSetting\MonthlyCostSettingUpdateRequest;

class MonthlyCostSettingUpdateController extends Controller
{
    public function index(Request $request)
    {
        // 月額経費IDをセッションにセット
        session(['monthly_cost_setting_id' => $request->monthly_cost_setting_id]);
        // 月額経費を取得
        $monthly_cost_setting = MonthlyCostSetting::getSpecify($request->monthly_cost_setting_id)->first();
        return view('monthly_cost_setting.update')->with([
            'monthly_cost_setting' => $monthly_cost_setting,
        ]);
    }

    public function update(MonthlyCostSettingUpdateRequest $request)
    {
        // インスタンス化
        $MonthlyCostSettingUpdateService = new MonthlyCostSettingUpdateService;
        // 月額経費を更新
        $MonthlyCostSettingUpdateService->updateMonthlyCostSetting($request);
        return redirect(session('back_url_1'))->with([
            'alert_type' => 'success',
            'alert_message' => '月額経費の更新が完了しました。',
        ]);
    }
}
