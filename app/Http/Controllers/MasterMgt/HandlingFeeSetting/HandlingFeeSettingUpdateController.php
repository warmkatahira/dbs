<?php

namespace App\Http\Controllers\MasterMgt\HandlingFeeSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
use App\Models\Handling;
use App\Models\CustomerHandling;
// サービス
use App\Services\MasterMgt\HandlingFeeSetting\HandlingFeeSettingUpdateService;
// リクエスト
use App\Http\Requests\MasterMgt\HandlingFeeSetting\HandlingFeeSettingUpdateRequest;

class HandlingFeeSettingUpdateController extends Controller
{
    public function index(Request $request)
    {
        // 荷役設定を取得
        $customer_handling = CustomerHandling::getSpecify($request->customer_handling_id)->first();
        // 荷主情報を取得
        $customer = Customer::getSpecify($customer_handling->customer_id)->first();
        // 荷役を全て取得
        $handlings = Handling::getAll()->get();
        return view('master_mgt.handling_fee_setting.update')->with([
            'customer_handling' => $customer_handling,
            'customer' => $customer,
            'handlings' => $handlings,
        ]);
    }

    public function update(HandlingFeeSettingUpdateRequest $request)
    {
        // インスタンス化
        $HandlingFeeSettingUpdateService = new HandlingFeeSettingUpdateService;
        // 荷役設定を更新
        $HandlingFeeSettingUpdateService->updateCustomerHandling($request);
        return redirect()->away(session('back_url_2'))->with([
            'alert_type' => 'success',
            'alert_message' => '荷役設定を更新しました。',
        ]);
    }
}
