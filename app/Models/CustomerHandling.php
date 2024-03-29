<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerHandling extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // テーブル名を定義
    protected $table = 'customer_handling';
    // 主キーカラムを変更
    protected $primaryKey = 'customer_handling_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'customer_id',
        'handling_id',
        'handling_fee_unit_price',
        'handling_fee_note',
        'handling_fee_sort_order',
    ];
    // 指定したレコードを取得
    public static function getSpecify($customer_handling_id)
    {
        return self::where('customer_handling_id', $customer_handling_id);
    }
}
