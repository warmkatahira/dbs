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
    // オートインクリメント無効化
    public $incrementing = false;
    // 操作可能なカラムを定義
    protected $fillable = [
        'handling_id',
        'handling_name',
    ];
    // 全てを取得
    public static function getAll()
    {
        return self::orderBy('handling_id', 'asc');
    }
    // customersテーブルとのリレーション(中間テーブル用)
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_handling', 'handling_id', 'customer_id')
                    ->withTimeStamps();
    }
}
