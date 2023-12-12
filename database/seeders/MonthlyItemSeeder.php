<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MonthlyItem;

class MonthlyItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MonthlyItem::create([
            'monthly_item_category_1' => '売上',
            'monthly_item_category_2' => null,
            'monthly_item_name' => '資材',
            'monthly_item_note' => null,
        ]);
        MonthlyItem::create([
            'monthly_item_category_1' => '売上',
            'monthly_item_category_2' => null,
            'monthly_item_name' => 'システム使用料',
            'monthly_item_note' => null,
        ]);
        MonthlyItem::create([
            'monthly_item_category_1' => '経費',
            'monthly_item_category_2' => '毎月',
            'monthly_item_name' => '本社管理費',
            'monthly_item_note' => null,
        ]);
        MonthlyItem::create([
            'monthly_item_category_1' => '経費',
            'monthly_item_category_2' => '毎月',
            'monthly_item_name' => '月額経費',
            'monthly_item_note' => null,
        ]);
        MonthlyItem::create([
            'monthly_item_category_1' => '経費',
            'monthly_item_category_2' => '変動',
            'monthly_item_name' => '資材',
            'monthly_item_note' => null,
        ]);
    }
}
