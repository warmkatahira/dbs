<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'shipping_method_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'delivery_company_id',
        'shipping_method_name',
        'shipping_method_sort_order',
    ];
    // 指定したレコードを取得
    public static function getSpecify($shipping_method_id)
    {
        return self::where('shipping_method_id', $shipping_method_id);
    }
    // DB:dbsのdelivery_companiesテーブルとのリレーション
    public function delivery_company()
    {
        return $this->belongsTo(DeliveryCompany::class, 'delivery_company_id', 'delivery_company_id');
    }
    // customersテーブルとのリレーション(中間テーブル用)
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_shipping_method', 'shipping_method_id', 'customer_id')->withTimeStamps();
    }
}
