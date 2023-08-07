<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KintaiBase extends Model
{
    // 接続するDBをセット
    protected $connection = 'kintai';
    // 接続するテーブルをセット
    protected $table = 'bases';
    // 全てを取得
    public static function getAll()
    {
        return self::orderBy('base_id', 'asc');
    }
}
