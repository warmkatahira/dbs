<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Handling;

class HandlingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Handling::create([
            'handling_id' => '2-0-0',
            'handling_name' => '荷役料',
        ]);
        Handling::create([
            'handling_id' => '2-1-1',
            'handling_name' => '入荷　コンテナ　デバン',
        ]);
        Handling::create([
            'handling_id' => '2-1-2',
            'handling_name' => '入荷　パレット',
        ]);
        Handling::create([
            'handling_id' => '2-1-3',
            'handling_name' => '入荷　ケース',
        ]);
        Handling::create([
            'handling_id' => '2-1-4',
            'handling_name' => '入荷　ボール',
        ]);
        Handling::create([
            'handling_id' => '2-1-5',
            'handling_name' => '入荷　ピース',
        ]);
        Handling::create([
            'handling_id' => '2-2-1',
            'handling_name' => '出荷　コンテナ　バン',
        ]);
        Handling::create([
            'handling_id' => '2-2-2',
            'handling_name' => '出荷　パレット',
        ]);
        Handling::create([
            'handling_id' => '2-2-3',
            'handling_name' => '出荷　ケース',
        ]);
        Handling::create([
            'handling_id' => '2-2-4',
            'handling_name' => '出荷　ボール',
        ]);
        Handling::create([
            'handling_id' => '2-2-5',
            'handling_name' => '出荷　ピース',
        ]);
        Handling::create([
            'handling_id' => '2-3-1',
            'handling_name' => '入庫（格納）　コンテナ　デバン',
        ]);
        Handling::create([
            'handling_id' => '2-3-2',
            'handling_name' => '入庫（格納）　パレット',
        ]);
        Handling::create([
            'handling_id' => '2-3-3',
            'handling_name' => '入庫（格納）　ケース',
        ]);
        Handling::create([
            'handling_id' => '2-3-4',
            'handling_name' => '入庫（格納）　ボール',
        ]);
        Handling::create([
            'handling_id' => '2-3-5',
            'handling_name' => '入庫（格納）　ピース',
        ]);
        Handling::create([
            'handling_id' => '2-4-1',
            'handling_name' => '出庫（ピッキング）　コンテナ　バン',
        ]);
        Handling::create([
            'handling_id' => '2-4-2',
            'handling_name' => '出庫（ピッキング）　パレット',
        ]);
        Handling::create([
            'handling_id' => '2-4-3',
            'handling_name' => '出庫（ピッキング）　ケース',
        ]);
        Handling::create([
            'handling_id' => '2-4-4',
            'handling_name' => '出庫（ピッキング）　ボール',
        ]);
        Handling::create([
            'handling_id' => '2-4-5',
            'handling_name' => '出庫（ピッキング）　ピース',
        ]);
        Handling::create([
            'handling_id' => '2-5-1',
            'handling_name' => '梱包',
        ]);
        Handling::create([
            'handling_id' => '2-5-2',
            'handling_name' => 'バンド・結束',
        ]);
        Handling::create([
            'handling_id' => '2-5-3',
            'handling_name' => '検品作業',
        ]);
        Handling::create([
            'handling_id' => '2-5-4',
            'handling_name' => '付帯作業',
        ]);
        Handling::create([
            'handling_id' => '2-5-5',
            'handling_name' => '加工作業',
        ]);
        Handling::create([
            'handling_id' => '2-5-6',
            'handling_name' => 'ラベル',
        ]);
        Handling::create([
            'handling_id' => '2-6-1',
            'handling_name' => '納品書作成',
        ]);
        Handling::create([
            'handling_id' => '2-6-2',
            'handling_name' => '送り状印刷',
        ]);
        Handling::create([
            'handling_id' => '2-6-3',
            'handling_name' => '事務手数料',
        ]);
        Handling::create([
            'handling_id' => '2-6-4',
            'handling_name' => '着払い手数料',
        ]);
        Handling::create([
            'handling_id' => '2-6-5',
            'handling_name' => '返品手数料',
        ]);
        Handling::create([
            'handling_id' => '2-6-6',
            'handling_name' => '業務委託料',
        ]);
        Handling::create([
            'handling_id' => '2-7-1',
            'handling_name' => '棚卸作業',
        ]);        
    }
}
