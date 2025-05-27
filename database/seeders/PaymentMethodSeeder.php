<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Efectivo'],
            ['name' => 'Transferencia'],
        ];
        foreach ($data as $item) {
            PaymentMethod::create($item);
        }
    }
}
