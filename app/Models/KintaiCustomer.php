<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KintaiCustomer extends Model
{
    // 接続するDBをセット
    protected $connection = 'kintai';
    // 接続するテーブルをセット
    protected $table = 'customers';
    // DB:kintaiのbasesテーブルとのリレーション
    public function kintai_base()
    {
        return $this->belongsTo(KintaiBase::class, 'base_id', 'base_id');
    }
    // 全てを取得
    public static function getAll()
    {
        return self::orderBy('customer_id', 'asc');
    }
}
