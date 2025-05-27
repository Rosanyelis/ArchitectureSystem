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
        $materials = [
            'Cemento',
            'Arena',
            'Piedra 1/3',
            'Piedra',
            'Hierro 10/12',
            'Hierro 6',
            'Hierro 6/8',
            'Alambre atar',
            'Cal',
            'Cascote',
            'Hierro 8',
            'Hierro 8/10',
            'Hierro 4,2',
            'Hierro 10',
            'Cemento Alb.',
            'Ladrillo común',
            'Ladrillo hueco 8x18x33',
            'Ladrillo Hueco 12x18x33',
            'Ladrillo hueco 12x19x33',
            'Ladrillo H° 9x19x39',
            'Ladrillo H° 12x19x39',
            'Ladrillo H° 15x19x39',
            'Ladrillo H° 19x19x39',
            'Hidrófugo',
            'Pintura asf.',
            'Poliestireno exp. mol.',
            'Tejuela ladrillo comun',
            'Pegamento impermeable',
            'Laca al agua',
            'Latex interior',
            'Latex exterior',
            'Microcemento',
            'Pintura',
            'Fijador',
            'Fijador al agua',
            'Latex',
            'Membrana',
            'Cartucho 300ml',
            'Longitud estribos',
            'Cantidad de estribos',
            'Hierro estribos 4,2mm',
            'Hierro arm. Ppal 6mm',
            'Hierro arm. Ppal 8mm',
            'Hierro arm. Ppal 10mm',
            'Hierro arm. Ppal 12mm',
            'Hierro arm. Ppal 16mm',
        ];

        foreach ($materials as $material) {
            Material::create([
                'name' => $material,
            ]);
        }
    }
}
