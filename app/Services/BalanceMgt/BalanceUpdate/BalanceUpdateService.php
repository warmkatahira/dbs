<?php

namespace App\Services\BalanceMgt\BalanceUpdate;

// モデル
use App\Models\BalanceShippingFee;
use App\Models\BalanceHandlingFee;
// その他
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BalanceUpdateService
{
    // 収支運賃を更新
    public function updateBalanceShippingFee($balance, $request)
    {
        // 現在の運賃を削除
        BalanceShippingFee::where('balance_id', $balance->balance_id)->delete();
        // パラメータがある場合のみ処理を行う
        if(isset($request->shipping_method_id)){
            // 追加に使用する変数を初期化
            $data = [];
            $count = 0;
            // 追加する情報の分だけループ処理
            foreach($request->shipping_method_id as $key => $shipping_method_id){
                // カウントアップ
                $count++;
                // 追加する情報を配列に格納
                $data[] = [
                    'balance_shipping_fee_id' => $request->balance_id.'_'.sprintf('%03d', $count),
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
            // 追加
            BalanceShippingFee::upsert($data, 'balance_shipping_fee_id');
        }
        return;
    }

    // 収支荷役を更新
    public function updateBalanceHandlingFee($balance, $request)
    {
        // 現在の荷役を削除
        BalanceHandlingFee::where('balance_id', $request->balance_id)->delete();
        // パラメータがある場合のみ処理を行う
        if(isset($request->handling_id)){
            // 追加に使用する変数を初期化
            $data = [];
            $count = 0;
            // 追加する情報の分だけループ処理
            foreach($request->handling_id as $key => $handling_id){
                // カウントアップ
                $count++;
                // 追加する情報を配列に格納
                $data[] = [
                    'balance_handling_fee_id' => $request->balance_id.'_'.sprintf('%03d', $count),
                    'balance_id' => $request->balance_id,
                    'handling_id' => $request->handling_id[$key],
                    'handling_fee_quantity' => $request->handling_fee_quantity[$key],
                    'handling_fee_unit_price' => $request->handling_fee_unit_price[$key],
                    'handling_fee_amount' => $request->handling_fee_amount[$key],
                    'handling_fee_note' => $request->handling_fee_note[$key],
                ];
            }
            // 追加
            BalanceHandlingFee::upsert($data, 'balance_handling_fee_id');
        }
        return;
    }

    // 収支を更新
    public function updateBalance($balance)
    {
        // 変数を初期化
        $sales = 0;
        $cost = 0;
        $profit = 0;
        // +-+-+-+-+-+-+-+-+-売上を集計する+-+-+-+-+-+-+-+-+-
        // 保管売上
        $sales += $balance->balance_storage->storage_sales;
        // 運賃売上
        $sales += $balance->balance_shipping_fees->sum('shipping_fee_amount_sales');
        // 荷役売上
        $sales += $balance->balance_handling_fees->sum('handling_fee_amount');
        // +-+-+-+-+-+-+-+-+-経費を集計する+-+-+-+-+-+-+-+-+-
        // 保管経費
        $cost += $balance->balance_storage->storage_cost;
        // 月額経費(本社管理費・月額経費)
        $cost += $balance->balance_monthly_cost->ho_cost;
        $cost += $balance->balance_monthly_cost->monthly_cost;
        // 人件費(正社員・契約社員・パート)
        $cost += $balance->balance_labor_cost->fulltime_labor_cost;
        $cost += $balance->balance_labor_cost->contract_labor_cost;
        $cost += $balance->balance_labor_cost->parttime_labor_cost;
        // 運賃経費
        $sales += $balance->balance_shipping_fees->sum('shipping_fee_amount_amount');
        // +-+-+-+-+-+-+-+-+-利益を集計する+-+-+-+-+-+-+-+-+-
        $profit = $sales - $cost;
        // 収支を更新
        $balance->update([
            'sales' => $sales,
            'cost' => $cost,
            'profit' => $profit,
            'last_updated_user_id' => Auth::user()->user_id,
        ]);
        return;
    }
}