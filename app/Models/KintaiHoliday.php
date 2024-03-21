<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KintaiHoliday extends Model
{
    // 接続するDBをセット
    protected $connection = 'kintai';
    // 接続するテーブルをセット
    protected $table = 'holidays';
    // 全てを取得
    public static function getAll()
    {
        return self::orderBy('holiday', 'asc');
    }
}
