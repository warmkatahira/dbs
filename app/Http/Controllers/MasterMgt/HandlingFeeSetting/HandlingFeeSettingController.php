<?php

namespace App\Http\Controllers\MasterMgt\HandlingFeeSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;

class HandlingFeeSettingController extends Controller
{
    public function index(Request $request)
    {
        // 現在のURLを取得
        session(['back_url_2' => url()->full()]);
        // 荷主情報を取得
        $customer = Customer::getSpecify($request->customer_id)->first();
        // 荷役設定を取得
        $handling_fee_settings = $customer->handlings;
        return view('master_mgt.handling_fee_setting.index')->with([
            'customer' => $customer,
            'handling_fee_settings' => $handling_fee_settings,
        ]);
    }
}
