<?php

namespace App\Http\Controllers\MasterMgt\ShippingFeeSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
use App\Models\DeliveryCompany;
use App\Models\CustomerShippingMethod;
// サービス
use App\Services\MasterMgt\ShippingFeeSetting\ShippingFeeSettingUpdateService;
// リクエスト
use App\Http\Requests\MasterMgt\ShippingFeeSetting\ShippingFeeSettingUpdateRequest;

class ShippingFeeSettingUpdateController extends Controller
{
    public function index(Request $request)
    {
        // 運賃設定を取得
        $customer_shipping_method = CustomerShippingMethod::getSpecify($request->customer_shipping_method_id)->first();
        // 荷主情報を取得
        $customer = Customer::getSpecify($customer_shipping_method->customer_id)->first();
        // 運送会社を全て取得
        $delivery_companies = DeliveryCompany::getAll()->with('shipping_methods')->get();
        return view('master_mgt.shipping_fee_setting.update')->with([
            'customer_shipping_method' => $customer_shipping_method,
            'customer' => $customer,
            'delivery_companies' => $delivery_companies,
        ]);
    }

    public function update(ShippingFeeSettingUpdateRequest $request)
    {
        // インスタンス化
        $ShippingFeeSettingUpdateService = new ShippingFeeSettingUpdateService;
        // 運賃設定を更新
        $ShippingFeeSettingUpdateService->updateCustomerShippingMethod($request);
        return redirect()->away(session('back_url_2'))->with([
            'alert_type' => 'success',
            'alert_message' => '運賃設定を更新しました。',
        ]);
    }
}
