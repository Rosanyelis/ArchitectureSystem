<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'Peso', 'abbreviation' => 'ARS'],
            ['name' => 'Dólar', 'abbreviation' => 'USD'],
        ];
        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
