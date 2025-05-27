<?php

namespace Database\Seeders;

use App\Models\DollarRate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DollarRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DollarRate::create([
            'rate' => '1156,38',
        ]);
    }
}
