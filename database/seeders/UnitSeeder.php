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
            ['name' => 'metro cúbico', 'abbreviation' => 'm3'],
            ['name' => 'kilogramo', 'abbreviation' => 'kg'],
            ['name' => 'tonelada', 'abbreviation' => 'ton'],
            ['name' => 'unidad', 'abbreviation' => 'u'],
            ['name' => 'metro', 'abbreviation' => 'm'],
            ['name' => 'centímetro', 'abbreviation' => 'cm'],
            ['name' => 'milímetro', 'abbreviation' => 'mm'],
            ['name' => 'milímetro cuadrado', 'abbreviation' => 'mm2'],
            ['name' => 'milímetro cúbico', 'abbreviation' => 'mm3'],
            ['name' => 'mililitro', 'abbreviation' => 'ml'],
            ['name' => 'litro', 'abbreviation' => 'lts'],
            ['name' => 'galón', 'abbreviation' => 'gal'],
            ['name' => 'pie', 'abbreviation' => 'pie'],
            ['name' => 'pulgada', 'abbreviation' => 'pulg'],
            ['name' => 'yarda', 'abbreviation' => 'yd'],
            ['name' => 'libra', 'abbreviation' => 'lb'],
        ];

        foreach ($data as $unit) {
            Unit::create($unit);
        }
    }
}
