<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'item_category_1' => '売上',
            'item_category_2' => '',
            'item_name' => '資材',
            'item_note' => '',
        ]);
        Item::create([
            'item_category_1' => '売上',
            'item_category_2' => '',
            'item_name' => 'システム使用料',
            'item_note' => '',
        ]);
        Item::create([
            'item_category_1' => '経費',
            'item_category_2' => '毎月',
            'item_name' => '本社管理費',
            'item_note' => '',
        ]);
        Item::create([
            'item_category_1' => '経費',
            'item_category_2' => '毎月',
            'item_name' => '月額経費',
            'item_note' => '',
        ]);
        Item::create([
            'item_category_1' => '経費',
            'item_category_2' => '変動',
            'item_name' => '資材',
            'item_note' => '',
        ]);
    }
}
