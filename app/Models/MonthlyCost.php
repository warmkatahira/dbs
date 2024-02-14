<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyCostSetting extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'monthly_cost_setting_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'base_id',
        'monthly_cost_setting_ym',
        'monthly_cost_setting_item_id',
        'monthly_cost_setting',
    ];
    // 指定したレコードを取得
    public static function getSpecify($monthly_cost_setting_id)
    {
        return self::where('monthly_cost_setting_id', $monthly_cost_setting_id);
    }
    // DB:dbsのitemsテーブルとのリレーション
    public function dbs_item()
    {
        return $this->belongsTo(MonthlyItem::class, 'monthly_cost_setting_item_id', 'monthly_item_id');
    }
    // DB:dbsのbasesテーブルとのリレーション
    public function dbs_base()
    {
        return $this->belongsTo(Base::class, 'base_id', 'base_id');
    }
}
