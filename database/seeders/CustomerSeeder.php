<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'customer_id' => '230628-001',
            'monthly_storage_sales' => 500000,
            'monthly_storage_cost' => 450000,
            'working_days' => 20,
        ]);
        Customer::create([
            'customer_id' => '230628-002',
            'monthly_storage_sales' => 700000,
            'monthly_storage_cost' => 600000,
            'working_days' => 20,
        ]);
        Customer::create([
            'customer_id' => '230729-001',
            'monthly_storage_sales' => 250000,
            'monthly_storage_cost' => 200000,
            'working_days' => 20,
        ]);
    }
}
