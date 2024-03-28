<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'balance_id';
    // オートインクリメント無効化
    public $incrementing = false;
    // 操作可能なカラムを定義
    protected $fillable = [
        'balance_id',
        'customer_id',
        'balance_date',
        'sales',
        'cost',
        'profit',
        'note',
        'last_updated_user_id',
    ];
    // 指定したレコードを取得
    public static function getSpecify($balance_id)
    {
        return self::where('balance_id', $balance_id);
    }
    // DB:dbsのbalance_storagesテーブルとのリレーション
    public function balance_storage()
    {
        return $this->hasOne(BalanceStorage::class, 'balance_id', 'balance_id');
    }
    // DB:dbsのbalance_monthly_costsテーブルとのリレーション
    public function balance_monthly_cost()
    {
        return $this->hasOne(BalanceMonthlyCost::class, 'balance_id', 'balance_id');
    }
    // DB:dbsのbalance_labor_costsテーブルとのリレーション
    public function balance_labor_cost()
    {
        return $this->hasOne(BalanceLaborCost::class, 'balance_id', 'balance_id');
    }
    // DB:dbsのbalance_shipping_feesテーブルとのリレーション
    public function balance_shipping_fees()
    {
        return $this->hasMany(BalanceShippingFee::class, 'balance_id', 'balance_id');
    }
    // DB:dbsのbalance_handling_feesテーブルとのリレーション
    public function balance_handling_fees()
    {
        return $this->hasMany(BalanceHandlingFee::class, 'balance_id', 'balance_id');
    }
}
