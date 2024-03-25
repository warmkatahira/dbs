<?php

namespace App\Http\Controllers\MasterMgt\ShippingFeeSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
use App\Models\DeliveryCompany;
// サービス
use App\Services\MasterMgt\ShippingFeeSetting\ShippingFeeSettingCreateService;
// リクエスト
use App\Http\Requests\MasterMgt\ShippingFeeSetting\ShippingFeeSettingCreateRequest;

class ShippingFeeSettingCreateController extends Controller
{
    public function index(Request $request)
    {
        // 荷主情報を取得
        $customer = Customer::getSpecify($request->customer_id)->first();
        // 運送会社を全て取得
        $delivery_companies = DeliveryCompany::getAll()->with('shipping_methods')->get();
        return view('master_mgt.shipping_fee_setting.create')->with([
            'customer' => $customer,
            'delivery_companies' => $delivery_companies,
        ]);
    }

    public function create(ShippingFeeSettingCreateRequest $request)
    {
        // インスタンス化
        $ShippingFeeSettingCreateService = new ShippingFeeSettingCreateService;
        // 運賃設定を追加
        $ShippingFeeSettingCreateService->createCustomerShippingMethod($request);
        return redirect()->away(session('back_url_2'))->with([
            'alert_type' => 'success',
            'alert_message' => '運賃設定を追加しました。',
        ]);
    }
}
