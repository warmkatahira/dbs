<?php

namespace App\Http\Controllers\Setting\SalesPlanSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\Setting\SalesPlanSetting\SalesPlanSettingCreateService;
// リクエスト
use App\Http\Requests\Setting\SalesPlanSetting\SalesPlanSettingCreateRequest;

class SalesPlanSettingCreateController extends Controller
{
    public function index(Request $request)
    {
        // 拠点を取得
        $base = Base::getSpecify(session('search_base_id'))->first();
        return view('sales_plan_setting.create')->with([
            'base' => $base,
        ]);
    }

    public function create(SalesPlanSettingCreateRequest $request)
    {
        // インスタンス化
        $SalesPlanSettingCreateService = new SalesPlanSettingCreateService;
        // 売上計画を登録
        $SalesPlanSettingCreateService->createSalesPlanSetting($request);
        return redirect(session('back_url_1'))->with([
            'alert_type' => 'success',
            'alert_message' => '売上計画の登録が完了しました。',
        ]);
    }
}
