<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerShippingMethod extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // テーブル名を定義
    protected $table = 'customer_shipping_method';
    // 主キーカラムを変更
    protected $primaryKey = 'customer_shipping_method_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'customer_id',
        'shipping_method_id',
        'shipping_fee_unit_price_sales',
        'shipping_fee_unit_price_cost',
        'shipping_fee_note',
    ];
}
