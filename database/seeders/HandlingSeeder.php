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
            'handling_name' => '入庫（バラ）',
        ]);
        Handling::create([
            'handling_name' => '入庫（ケース）',
        ]);
        Handling::create([
            'handling_name' => '出荷（バラ）',
        ]);
        Handling::create([
            'handling_name' => '出荷（ケース）',
        ]);
        Handling::create([
            'handling_name' => '梱包',
        ]);
        Handling::create([
            'handling_name' => 'セット作業',
        ]);
    }
}
