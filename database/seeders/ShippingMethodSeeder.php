<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingMethod::create([
            'delivery_company_id' => 'sagawa',
            'shipping_method_name' => '宅配便',
        ]);
        ShippingMethod::create([
            'delivery_company_id' => 'yamato',
            'shipping_method_name' => '宅配便',
        ]);
        ShippingMethod::create([
            'delivery_company_id' => 'yamato',
            'shipping_method_name' => 'ネコポス',
        ]);
        ShippingMethod::create([
            'delivery_company_id' => 'yamato',
            'shipping_method_name' => 'コンパクト',
        ]);
        ShippingMethod::create([
            'delivery_company_id' => 'jp',
            'shipping_method_name' => 'ゆうパック',
        ]);
        ShippingMethod::create([
            'delivery_company_id' => 'jp',
            'shipping_method_name' => 'EMS',
        ]);
    }
}
