<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'customer_id';
    // オートインクリメント無効化
    public $incrementing = false;
    // 操作可能なカラムを定義
    protected $fillable = [
        'customer_id',
        'base_id',
        'customer_name',
        'is_available',
        'customer_sort_order',
    ];
    // ヘッダーを定義
    public static function csvHeader()
    {
        return [
            '荷主ID',
            '拠点',
            '荷主名',
            '有効/無効',
        ];
    }
    // DB:dbsのbasesテーブルとのリレーション
    public function base()
    {
        return $this->belongsTo(Base::class, 'base_id', 'base_id');
    }
    // 全てを取得
    public static function getAll()
    {
        return self::orderBy('customer_sort_order', 'asc')
                    ->orderBy('base_id', 'asc')
                    ->orderBy('customer_id', 'asc');
    }
    // 指定したレコードを取得
    public static function getSpecify($customer_id)
    {
        return self::where('customer_id', $customer_id);
    }
    // 指定した拠点の有効な荷主を全て取得
    public static function getAllByBase($base_id)
    {
        return self::where('base_id', $base_id)
                    ->where('is_available', 1)
                    ->orderBy('customer_sort_order', 'asc')
                    ->orderBy('base_id', 'asc')
                    ->orderBy('customer_id', 'asc');
    }
    // shipping_methodsテーブルとのリレーション(中間テーブル用)
    public function shipping_methods()
    {
        return $this->belongsToMany(ShippingMethod::class, 'customer_shipping_method', 'customer_id', 'shipping_method_id')
                    ->orderBy('shipping_method_sort_order', 'asc')
                    ->orderBy('customer_shipping_method_id', 'asc')
                    ->withPivot('customer_shipping_method_id', 'shipping_fee_unit_price_sales', 'shipping_fee_unit_price_cost', 'shipping_fee_note')
                    ->withTimeStamps();
    }
    // handlingsテーブルとのリレーション(中間テーブル用)
    public function handlings()
    {
        return $this->belongsToMany(Handling::class, 'customer_handling', 'customer_id', 'handling_id')
                    ->orderBy('handling_fee_sort_order', 'asc')
                    ->withPivot('customer_handling_id', 'handling_fee_unit_price', 'handling_fee_note', 'handling_fee_sort_order')
                    ->withTimeStamps();
    }
}
