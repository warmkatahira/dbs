<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Balance;
use App\Models\Customer;
use App\Models\BalanceShippingFee;
use App\Models\BalanceHandlingFee;
// サービス
use App\Services\BalanceMgt\BalanceUpdate\BalanceUpdateValidationService;

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
        //dd($request->all());

        // 現在の運賃を削除
        BalanceShippingFee::where('balance_id', $request->balance_id)->delete();
        // 今回の運賃を登録
        $data = [];
        foreach($request->shipping_method_id as $key => $shipping_method_id){
            $data[] = [
                'balance_id' => $request->balance_id,
                'shipping_method_id' => $request->shipping_method_id[$key],
                'shipping_fee_quantity_sales' => $request->shipping_fee_quantity_sales[$key],
                'shipping_fee_unit_price_sales' => $request->shipping_fee_unit_price_sales[$key],
                'shipping_fee_amount_sales' => $request->shipping_fee_amount_sales[$key],
                'shipping_fee_quantity_cost' => $request->shipping_fee_quantity_cost[$key],
                'shipping_fee_unit_price_cost' => $request->shipping_fee_unit_price_cost[$key],
                'shipping_fee_amount_cost' => $request->shipping_fee_amount_cost[$key],
                'shipping_fee_note' => $request->shipping_fee_note[$key],
            ];
        }
        BalanceShippingFee::upsert($data, 'balance_shipping_fee_id');


        // 現在の荷役を削除
        BalanceHandlingFee::where('balance_id', $request->balance_id)->delete();
        // 今回の荷役を登録
        $data = [];
        foreach($request->handling_id as $key => $handling_id){
            $data[] = [
                'balance_id' => $request->balance_id,
                'handling_id' => $request->handling_id[$key],
                'handling_fee_quantity' => $request->handling_fee_quantity[$key],
                'handling_fee_unit_price' => $request->handling_fee_unit_price[$key],
                'handling_fee_amount' => $request->handling_fee_amount[$key],
                'handling_fee_note' => $request->handling_fee_note[$key],
            ];
        }
        BalanceHandlingFee::upsert($data, 'balance_handling_fee_id');


        dd('aaa');
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