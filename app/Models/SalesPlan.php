<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPlan extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'sales_plan_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'base_id',
        'sales_plan_ym',
        'sales_plan',
    ];
    // 指定したレコードを取得
    public static function getSpecify($sales_plan_id)
    {
        return self::where('sales_plan_id', $sales_plan_id);
    }
    // DB:dbsのbasesテーブルとのリレーション
    public function dbs_base()
    {
        return $this->belongsTo(Base::class, 'base_id', 'base_id');
    }

}
