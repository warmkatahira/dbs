<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceShippingFee extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'balance_shipping_fee_id';
    // オートインクリメント無効化
    public $incrementing = false;
    // 操作可能なカラムを定義
    protected $fillable = [
        'balance_shipping_fee_id',
        'balance_id',
        'shipping_method_id',
        'shipping_fee_quantity_sales',
        'shipping_fee_unit_price_sales',
        'shipping_fee_amount_sales',
        'shipping_fee_quantity_cost',
        'shipping_fee_unit_price_cost',
        'shipping_fee_amount_cost',
        'shipping_fee_note',
    ];
    // DB:dbsのshipping_methodsテーブルとのリレーション
    public function shipping_method()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id', 'shipping_method_id');
    }
}
