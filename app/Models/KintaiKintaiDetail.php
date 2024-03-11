<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KintaiKintaiDetail extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'kintai';
    // 接続するテーブルをセット
    protected $table = 'kintai_details';
    // DB:kintaiのkintaisテーブルとのリレーション
    public function kintai_kintai()
    {
        return $this->belongsTo(KintaiKintai::class, 'kintai_id', 'kintai_id');
    }
}
