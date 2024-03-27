<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Balance;
use App\Models\Customer;
use App\Models\BalanceShippingFee;
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
        return view('balance_mgt.balance_update.index')->with([
            'balance' => $balance,
            'balance_labor_cost' => $balance_labor_cost,
            'balance_monthly_cost' => $balance_monthly_cost,
            'balance_storage' => $balance_storage,
            'customer_shipping_methods' => $customer_shipping_methods,
            'balance_shipping_fees' => $balance_shipping_fees,
        ]);
    }

    public function update(Request $request)
    {
        //dd($request->all());

        // 現在の運賃を削除
        BalanceShippingFee::where('balance_id', $request->balance_id)->delete();
        // 今回の運賃を登録
        $data = [];
        foreach($request->shipping_fee_quantity_sales as $key => $shipping_fee){
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
        //dd($data);
        BalanceShippingFee::upsert($data, 'balance_shipping_fee_id');


        dd('aaa');
    }

    public function validation(Request $request)
    {
        // インスタンス化
        $BalanceUpdateValidationService = new BalanceUpdateValidationService;
        // 運賃のバリデーションを実施
        $balance_shipping_fee_errors = $BalanceUpdateValidationService->validationBalanceShippingFee($request);
        // 結果を返す
        return response()->json([
            'validation_errors' => $balance_shipping_fee_errors,
        ]);
    }
}
