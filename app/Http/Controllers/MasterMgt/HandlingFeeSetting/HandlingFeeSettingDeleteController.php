<?php

namespace App\Http\Controllers\MasterMgt\HandlingFeeSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// サービス
use App\Services\MasterMgt\HandlingFeeSetting\HandlingFeeSettingDeleteService;
// リクエスト
use App\Http\Requests\MasterMgt\HandlingFeeSetting\HandlingFeeSettingDeleteRequest;

class HandlingFeeSettingDeleteController extends Controller
{
    public function delete(HandlingFeeSettingDeleteRequest $request)
    {
        // インスタンス化
        $HandlingFeeSettingDeleteService = new HandlingFeeSettingDeleteService;
        // 荷役設定を削除
        $HandlingFeeSettingDeleteService->deleteCustomerHandling($request->customer_handling_id);
        return redirect()->away(session('back_url_2'))->with([
            'alert_type' => 'success',
            'alert_message' => '荷役設定を削除しました。',
        ]);
    }
}
