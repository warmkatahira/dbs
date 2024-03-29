<?php

namespace App\Services\BalanceMgt\BalanceUpdate;

// 列挙
use App\Enums\BalanceMgt\BalanceUpdate\BalanceValidationEnum;
use App\Enums\BalanceMgt\BalanceUpdate\BalanceShippingFeeValidationEnum;
use App\Enums\BalanceMgt\BalanceUpdate\BalanceHandlingFeeValidationEnum;
use App\Enums\BalanceMgt\BalanceUpdate\BalanceStorageValidationEnum;
use App\Enums\BalanceMgt\BalanceUpdate\BalanceMonthlyCostValidationEnum;
use App\Enums\BalanceMgt\BalanceUpdate\BalanceLaborCostValidationEnum;
// その他
use Illuminate\Support\Facades\Validator;

class BalanceUpdateValidationService
{
    public function validationBalance($request, $validation_errors)
    {
        // バリデーションする値を格納
        $param = [
            'balance_id' => $request->balance_id,
            'note' => $request->note,
        ];
        // バリデーション処理
        $validation_errors = $this->validation($validation_errors, $param, BalanceValidationEnum::RULES, BalanceValidationEnum::MESSAGES, BalanceValidationEnum::ATTRIBUTES);
        return $validation_errors;
    }

    public function validationBalanceShippingFee($request, $validation_errors)
    {
        // パラメータがある場合のみ処理を行う
        if(isset($request->shipping_method_id)){
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
        }
        return $validation_errors;
    }

    public function validationBalanceHandlingFee($request, $validation_errors)
    {
        // パラメータがある場合のみ処理を行う
        if(isset($request->handling_id)){
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
        }
        return $validation_errors;
    }

    public function validationBalanceStorage($request, $validation_errors)
    {
        // バリデーションする値を格納
        $param = [
            'storage_sales' => $request->storage_sales,
            'storage_cost' => $request->storage_cost,
        ];
        // バリデーション処理
        $validation_errors = $this->validation($validation_errors, $param, BalanceStorageValidationEnum::RULES, BalanceStorageValidationEnum::MESSAGES, BalanceStorageValidationEnum::ATTRIBUTES);
        return $validation_errors;
    }

    public function validationBalanceMonthlyCost($request, $validation_errors)
    {
        // バリデーションする値を格納
        $param = [
            'ho_cost' => $request->ho_cost,
            'monthly_cost' => $request->monthly_cost,
        ];
        // バリデーション処理
        $validation_errors = $this->validation($validation_errors, $param, BalanceMonthlyCostValidationEnum::RULES, BalanceMonthlyCostValidationEnum::MESSAGES, BalanceMonthlyCostValidationEnum::ATTRIBUTES);
        return $validation_errors;
    }

    public function validationBalanceLaborCost($request, $validation_errors)
    {
        // バリデーションする値を格納
        $param = [
            'fulltime_labor_cost' => $request->fulltime_labor_cost,
            'contract_labor_cost' => $request->contract_labor_cost,
            'parttime_labor_cost' => $request->parttime_labor_cost,
        ];
        // バリデーション処理
        $validation_errors = $this->validation($validation_errors, $param, BalanceLaborCostValidationEnum::RULES, BalanceLaborCostValidationEnum::MESSAGES, BalanceLaborCostValidationEnum::ATTRIBUTES);
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