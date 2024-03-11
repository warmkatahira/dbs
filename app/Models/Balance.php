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
    ];
    // DB:dbsのbalance_storagesテーブルとのリレーション
    public function dbs_balance_storage()
    {
        return $this->hasOne(BalanceStorage::class, 'balance_id', 'balance_id');
    }
    // DB:dbsのbalance_monthly_costsテーブルとのリレーション
    public function dbs_balance_monthly_cost()
    {
        return $this->hasOne(BalanceMonthlyCost::class, 'balance_id', 'balance_id');
    }
    // DB:dbsのbalance_labor_costsテーブルとのリレーション
    public function dbs_balance_labor_cost()
    {
        return $this->hasOne(BalanceLaborCost::class, 'balance_id', 'balance_id');
    }
}
