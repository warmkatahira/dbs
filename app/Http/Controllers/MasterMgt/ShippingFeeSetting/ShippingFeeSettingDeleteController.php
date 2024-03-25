<?php

namespace App\Http\Controllers\MasterMgt\ShippingFeeSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// サービス
use App\Services\MasterMgt\ShippingFeeSetting\ShippingFeeSettingDeleteService;
// リクエスト
use App\Http\Requests\MasterMgt\ShippingFeeSetting\ShippingFeeSettingDeleteRequest;

class ShippingFeeSettingDeleteController extends Controller
{
    public function delete(ShippingFeeSettingDeleteRequest $request)
    {
        // インスタンス化
        $ShippingFeeSettingDeleteService = new ShippingFeeSettingDeleteService;
        // 運賃設定を削除
        $ShippingFeeSettingDeleteService->deleteCustomerShippingMethod($request->customer_shipping_method_id);
        return redirect()->away(session('back_url_2'))->with([
            'alert_type' => 'success',
            'alert_message' => '運賃設定を削除しました。',
        ]);
    }
}
