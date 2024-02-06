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
        'monthly_storage_sales',
        'monthly_storage_cost',
        'is_available',
        'customer_sort_order',
        'cost_allocation_ratio',
    ];
    // ヘッダーを定義
    public static function csvHeader()
    {
        return [
            '荷主ID',
            '拠点',
            '荷主名',
            '月間保管売上',
            '月間保管経費',
            '本社管理費分配割合',
            '月額経費分配割合',
            '有効/無効',
        ];
    }
    // ヘッダーを定義
    public static function csvHeader_EN()
    {
        return [
            'customer_id',
            'base_name',
            'customer_name',
            'monthly_storage_sales',
            'monthly_storage_cost',
            'ho_cost_allocation_ratio',
            'monthly_cost_allocation_ratio',
            'is_available',
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
        return self::orderBy('customer_id', 'asc');
    }
    // 分配割合の合計を取得
    public static function getTotalCostAllocationRatio($base_id, $column)
    {
        return self::where('base_id', $base_id)
                    ->where('is_available', 1)
                    ->sum($column);
    }

}
