<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Balance;
// サービス
use App\Services\BalanceMgt\BalanceDetail\BalanceDetailService;
use App\Services\BalanceMgt\BalanceUpdate\BalanceUpdateValidationService;
use App\Services\BalanceMgt\BalanceUpdate\BalanceUpdateService;

class BalanceUpdateController extends Controller
{
    public function index(Request $request)
    {
        // インスタンス化
        $BalanceDetailService = new BalanceDetailService;
        // 収支の情報を取得
        $balance_data = $BalanceDetailService->getBalanceData($request->balance_id);
        return view('balance_mgt.balance_update.index')->with([
            'balance_data' => $balance_data,
        ]);
    }

    public function update(Request $request)
    {
        // インスタンス化
        $BalanceUpdateService = new BalanceUpdateService;
        // 更新対象の収支を取得
        $balance = Balance::getSpecify($request->balance_id)->first();
        // 収支運賃を更新
        $BalanceUpdateService->updateBalanceShippingFee($balance, $request);
        // 収支荷役を更新
        $BalanceUpdateService->updateBalanceHandlingFee($balance, $request);
        // 収支を更新
        $BalanceUpdateService->updateBalance($balance, $request);
        return redirect()->away(session('back_url_2'))->with([
            'alert_type' => 'success',
            'alert_message' => '収支を更新しました。',
        ]);
    }

    public function validation(Request $request)
    {
        // インスタンス化
        $BalanceUpdateValidationService = new BalanceUpdateValidationService;
        // バリデーションエラーを格納する変数を初期化
        $validation_errors = '';
        // 運賃のバリデーションを実施
        $validation_errors = $BalanceUpdateValidationService->validationBalanceShippingFee($request, $validation_errors);
        // 荷役のバリデーションを実施
        $validation_errors = $BalanceUpdateValidationService->validationBalanceHandlingFee($request, $validation_errors);
        // 保管のバリデーションを実施
        $validation_errors = $BalanceUpdateValidationService->validationBalanceStorage($request, $validation_errors);
        // 月額経費のバリデーションを実施
        $validation_errors = $BalanceUpdateValidationService->validationBalanceMonthlyCost($request, $validation_errors);
        // 人件費のバリデーションを実施
        $validation_errors = $BalanceUpdateValidationService->validationBalanceLaborCost($request, $validation_errors);
        // 結果を返す
        return response()->json([
            'validation_errors' => $validation_errors,
        ]);
    }
}