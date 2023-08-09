<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'mysql';
    // 主キーカラムを変更
    protected $primaryKey = 'item_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'item_category_1',
        'item_category_2',
        'item_name',
        'item_note',
    ];
    // 全てを取得
    public static function getAll()
    {
        return self::orderBy('item_id', 'asc');
    }
    // 指定された項目カテゴリ1のレコードを取得
    public static function getSpecifyByItemCategory1($item_category_1)
    {
        return self::where('item_category_1', $item_category_1)->orderBy('item_id', 'asc');
    }
}
