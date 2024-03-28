<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Balance;
use App\Models\Customer;
// サービス
use App\Services\BalanceMgt\BalanceUpdate\BalanceUpdateValidationService;
use App\Services\BalanceMgt\BalanceUpdate\BalanceUpdateService;

class BalanceUpdateController extends Controller
{
    public function index(Request $request)
    {
        // 収支を取得
        $balance = Balance::getSpecify($request->balance_id)->first();
        // 人件費を取得
        $balance_labor_cost = $balance->balance_labor_cost()->first();
        // 月額経費を取得
        $balance_monthly_cost = $balance->balance_monthly_cost()->first();
        // 保管売上・経費を取得
        $balance_storage = $balance->balance_storage()->first();
        // 荷主を取得
        $customer = Customer::getSpecify($balance->customer_id)->first();
        // 運賃設定を取得
        $customer_shipping_methods = $customer->shipping_methods()->get();
        // 現在登録されている運賃を取得
        $balance_shipping_fees = $balance->balance_shipping_fees()->get();
        // 荷役設定を取得
        $customer_handlings = $customer->handlings()->get();
        // 現在登録されている荷役を取得
        $balance_handling_fees = $balance->balance_handling_fees()->get();
        return view('balance_mgt.balance_update.index')->with([
            'balance' => $balance,
            'balance_labor_cost' => $balance_labor_cost,
            'balance_monthly_cost' => $balance_monthly_cost,
            'balance_storage' => $balance_storage,
            'customer_shipping_methods' => $customer_shipping_methods,
            'balance_shipping_fees' => $balance_shipping_fees,
            'customer_handlings' => $customer_handlings,
            'balance_handling_fees' => $balance_handling_fees,
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
        // 結果を返す
        return response()->json([
            'validation_errors' => $validation_errors,
        ]);
    }
}