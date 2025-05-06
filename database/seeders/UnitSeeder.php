<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'm3', 'abbreviation' => 'm3'],
            ['name' => 'kg', 'abbreviation' => 'kg'],
            ['name' => 'toneladas', 'abbreviation' => 'ton'],
            ['name' => 'unidades', 'abbreviation' => 'und'],
            ['name' => 'metros', 'abbreviation' => 'm'],
            ['name' => 'centímetros', 'abbreviation' => 'cm'],
            ['name' => 'milímetros', 'abbreviation' => 'mm'],
        ];

        foreach ($data as $unit) {
            Unit::create($unit);
        }
    }
}
