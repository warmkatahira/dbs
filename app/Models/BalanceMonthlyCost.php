<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceMonthlyCost extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'balance_monthly_cost_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'balance_id',
        'ho_cost',
        'monthly_cost',
    ];
}
