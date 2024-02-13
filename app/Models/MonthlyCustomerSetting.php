<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyCustomerSetting extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'monthly_customer_setting_id';
    // オートインクリメント無効化
    public $incrementing = false;
    // 操作可能なカラムを定義
    protected $fillable = [
        'customer_id',
        'monthly_customer_setting_ym',
        'monthly_storage_sales',
        'monthly_storage_cost',
        'customer_sort_order',
        'cost_allocation_ratio',
    ];
    // DB:dbsのcustomersテーブルとのリレーション
    public function dbs_customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
    // 分配割合の合計を取得
    public static function getTotalCostAllocationRatio($base_id, $monthly_customer_setting_ym, $column)
    {
        return self::whereHas('dbs_customer.dbs_base', function ($query) use ($base_id) {
                        $query->where('base_id', $base_id);
                    })
                    ->where('monthly_customer_setting_ym', $monthly_customer_setting_ym)
                    ->whereHas('dbs_customer', function ($query){
                        $query->where('is_available', 1);
                    })
                    ->sum($column);
    }
}
