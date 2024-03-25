<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCompany extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'delivery_company_id';
    // オートインクリメント無効化
    public $incrementing = false;
    // 操作可能なカラムを定義
    protected $fillable = [
        'delivery_company_id',
        'delivery_company_name',
        'company_image',
        'delivery_company_sort_order',
    ];
    // 全てを取得
    public static function getAll()
    {
        return self::orderBy('delivery_company_sort_order', 'asc');
    }
    // shipping_methodsテーブルとのリレーション
    public function shipping_methods()
    {
        return $this->hasMany(ShippingMethod::class, 'delivery_company_id', 'delivery_company_id');
    }
}
