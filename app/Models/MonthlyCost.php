<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyCost extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'monthly_cost_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'base_id',
        'monthly_cost_ym',
        'monthly_cost_item_id',
        'monthly_cost',
    ];
    // 指定したレコードを取得
    public static function getSpecify($monthly_cost_id)
    {
        return self::where('monthly_cost_id', $monthly_cost_id);
    }
    // DB:dbsのitemsテーブルとのリレーション
    public function dbs_item()
    {
        return $this->belongsTo(Item::class, 'monthly_cost_item_id', 'item_id');
    }
}
