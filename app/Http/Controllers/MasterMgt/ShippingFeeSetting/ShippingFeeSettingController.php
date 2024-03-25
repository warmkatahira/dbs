<?php

namespace App\Http\Controllers\MasterMgt\ShippingFeeSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;

class ShippingFeeSettingController extends Controller
{
    public function index(Request $request)
    {
        // 現在のURLを取得
        session(['back_url_2' => url()->full()]);
        // 荷主情報を取得
        $customer = Customer::getSpecify($request->customer_id)->first();
        // 運賃設定を取得
        $shipping_fee_settings = $customer->shipping_methods;
        return view('master_mgt.shipping_fee_setting.index')->with([
            'customer' => $customer,
            'shipping_fee_settings' => $shipping_fee_settings,
        ]);
    }
}
