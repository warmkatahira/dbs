<?php

namespace App\Services\BalanceMgt\BalanceUpdate;

// 列挙
use App\Enums\BalanceMgt\BalanceUpdate\BalanceShippingFeeValidationEnum;
use App\Enums\BalanceMgt\BalanceUpdate\BalanceHandlingFeeValidationEnum;
// その他
use Illuminate\Support\Facades\Validator;

class BalanceUpdateValidationService
{
    public function validationBalanceShippingFee($request, $validation_errors)
    {
        // レコードの分だけループ処理
        foreach($request->shipping_method_id as $key => $value){
            // バリデーションする値を格納
            $param = [
                'shipping_method_id' => $request->shipping_method_id[$key],
                'shipping_fee_quantity_sales' => $request->shipping_fee_quantity_sales[$key],
                'shipping_fee_unit_price_sales' => $request->shipping_fee_unit_price_sales[$key],
                'shipping_fee_amount_sales' => $request->shipping_fee_amount_sales[$key],
                'shipping_fee_quantity_cost' => $request->shipping_fee_quantity_cost[$key],
                'shipping_fee_unit_price_cost' => $request->shipping_fee_unit_price_cost[$key],
                'shipping_fee_amount_cost' => $request->shipping_fee_amount_cost[$key],
                'shipping_fee_note' => $request->shipping_fee_note[$key],
            ];
            // バリデーション処理
            $validation_errors = $this->validation($validation_errors, $param, BalanceShippingFeeValidationEnum::RULES, BalanceShippingFeeValidationEnum::MESSAGES, BalanceShippingFeeValidationEnum::ATTRIBUTES);
        }
        return $validation_errors;
    }

    public function validationBalanceHandlingFee($request, $validation_errors)
    {
        // レコードの分だけループ処理
        foreach($request->handling_id as $key => $value){
            // バリデーションする値を格納
            $param = [
                'handling_id' => $request->handling_id[$key],
                'handling_fee_quantity' => $request->handling_fee_quantity[$key],
                'handling_fee_unit_price' => $request->handling_fee_unit_price[$key],
                'handling_fee_amount' => $request->handling_fee_amount[$key],
                'handling_fee_note' => $request->handling_fee_note[$key],
            ];
            // バリデーション処理
            $validation_errors = $this->validation($validation_errors, $param, BalanceHandlingFeeValidationEnum::RULES, BalanceHandlingFeeValidationEnum::MESSAGES, BalanceHandlingFeeValidationEnum::ATTRIBUTES);
        }
        return $validation_errors;
    }

    // バリデーション処理
    public function validation($validation_errors, $param, $rules, $messages, $attributes)
    {
        // バリデーション実施
        $validator = Validator::make($param, $rules, $messages, $attributes);
        // バリデーションエラーを格納する変数をセット
        $messages = [];
        // バリデーションエラーの分だけループ
        foreach($validator->errors()->toArray() as $key => $errors){
            // エラー内容を格納
            $validation_errors = empty($validation_errors) ? array_shift($errors).'['.$param[$key].']' : $validation_errors."<br>".array_shift($errors).'['.$param[$key].']';
        }
        return $validation_errors;
    }
}