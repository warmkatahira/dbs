<?php

namespace App\Http\Controllers\MasterMgt\HandlingFeeSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
use App\Models\Handling;
// サービス
use App\Services\MasterMgt\HandlingFeeSetting\HandlingFeeSettingCreateService;
// リクエスト
use App\Http\Requests\MasterMgt\HandlingFeeSetting\HandlingFeeSettingCreateRequest;

class HandlingFeeSettingCreateController extends Controller
{
    public function index(Request $request)
    {
        // 荷主情報を取得
        $customer = Customer::getSpecify($request->customer_id)->first();
        // 荷役を全て取得
        $handlings = Handling::getAll()->get();
        return view('master_mgt.handling_fee_setting.create')->with([
            'customer' => $customer,
            'handlings' => $handlings,
        ]);
    }

    public function create(HandlingFeeSettingCreateRequest $request)
    {
        // インスタンス化
        $HandlingFeeSettingCreateService = new HandlingFeeSettingCreateService;
        // 荷役設定を追加
        $HandlingFeeSettingCreateService->createCustomerHandling($request);
        return redirect()->away(session('back_url_2'))->with([
            'alert_type' => 'success',
            'alert_message' => '荷役設定を追加しました。',
        ]);
    }
}
