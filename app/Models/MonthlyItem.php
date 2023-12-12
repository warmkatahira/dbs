<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyItem extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'monthly_item_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'monthly_item_category_1',
        'monthly_item_category_2',
        'monthly_item_name',
        'monthly_item_note',
    ];
    // 全てを取得
    public static function getAll()
    {
        return self::orderBy('monthly_item_id', 'asc');
    }
    // 指定された項目カテゴリ1のレコードを取得
    public static function getSpecifyByItemCategory1($item_category_1)
    {
        return self::where('monthly_item_category_1', $item_category_1)->orderBy('monthly_item_id', 'asc');
    }
}
