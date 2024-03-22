<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceStorage extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'balance_storage_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'balance_id',
        'storage_sales',
        'storage_cost',
    ];
    // balance_idを指定して取得
    public static function getSpecifyByBalanceId($balance_id)
    {
        return self::where('balance_id', $balance_id);
    }
}
