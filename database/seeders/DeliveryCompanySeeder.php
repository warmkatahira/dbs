<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryCompany;

class DeliveryCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryCompany::create([
            'delivery_company_id' => 'sagawa',
            'delivery_company_name' => '佐川急便',
            'company_image' => 'sagawa.svg',
        ]);
        DeliveryCompany::create([
            'delivery_company_id' => 'yamato',
            'delivery_company_name' => 'ヤマト運輸',
            'company_image' => 'yamato.svg',
        ]);
        DeliveryCompany::create([
            'delivery_company_id' => 'jp',
            'delivery_company_name' => '日本郵便',
            'company_image' => 'jp.svg',
        ]);
    }
}
