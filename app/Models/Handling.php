<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Handling extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'handling_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'handling_name',
    ];
    // customersテーブルとのリレーション(中間テーブル用)
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_handling', 'handling_id', 'customer_id')->withTimeStamps();
    }
}
