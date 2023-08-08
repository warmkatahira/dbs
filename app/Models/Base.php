<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'base_id';
    // オートインクリメント無効化
    public $incrementing = false;
    // 操作可能なカラムを定義
    protected $fillable = [
        'base_id',
        'base_name',
    ];
    // 全てを取得
    public static function getAll()
    {
        return self::orderBy('base_id', 'asc');
    }
    // 指定したレコードを取得
    public static function getSpecify($base_id)
    {
        return self::where('base_id', $base_id);
    }
}
