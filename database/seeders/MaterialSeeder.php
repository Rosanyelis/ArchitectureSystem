<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Cemento'],
            ['name' => 'Arena'],
            ['name' => 'Piedra 1/3'],
            ['name' => 'Hierro 10/12'],
            ['name' => 'Hierro 6'],
            ['name' => 'Alambre atar'],
        ];

        foreach ($data as $material) {
            Material::create($material);
        }
    }
}
