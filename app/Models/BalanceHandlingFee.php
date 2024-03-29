<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceHandlingFee extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'balance_handling_fee_id';
    // オートインクリメント無効化
    public $incrementing = false;
    // 操作可能なカラムを定義
    protected $fillable = [
        'balance_handling_fee_id',
        'balance_id',
        'handling_id',
        'handling_fee_quantity',
        'handling_fee_unit_price',
        'handling_fee_amount',
        'handling_fee_note',
    ];
    // DB:dbsのhandlingsテーブルとのリレーション
    public function handling()
    {
        return $this->belongsTo(Handling::class, 'handling_id', 'handling_id');
    }
}
