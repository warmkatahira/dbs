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
            'shipping_method_sort_order' => 1,
        ]);
        ShippingMethod::create([
            'delivery_company_id' => 'yamato',
            'shipping_method_name' => '宅配便',
            'shipping_method_sort_order' => 2,
        ]);
        ShippingMethod::create([
            'delivery_company_id' => 'yamato',
            'shipping_method_name' => 'ネコポス',
            'shipping_method_sort_order' => 3,
        ]);
        ShippingMethod::create([
            'delivery_company_id' => 'yamato',
            'shipping_method_name' => 'コンパクト',
            'shipping_method_sort_order' => 4,
        ]);
        ShippingMethod::create([
            'delivery_company_id' => 'jp',
            'shipping_method_name' => 'ゆうパック',
            'shipping_method_sort_order' => 5,
        ]);
        ShippingMethod::create([
            'delivery_company_id' => 'jp',
            'shipping_method_name' => 'EMS',
            'shipping_method_sort_order' => 6,
        ]);
    }
}
