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
    public function dbs_base()
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
        return $this->belongsToMany(ShippingMethod::class, 'customer_shipping_method', 'customer_id', 'shipping_method_id')->withTimeStamps();
    }
    // handlingsテーブルとのリレーション(中間テーブル用)
    public function shipping_methods()
    {
        return $this->belongsToMany(Handling::class, 'customer_handling', 'customer_id', 'handling_id')->withTimeStamps();
    }
}
