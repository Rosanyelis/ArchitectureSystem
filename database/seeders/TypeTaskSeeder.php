<?php

namespace Database\Seeders;

use App\Models\TypeTask;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeTask = [
            'ZAPATA CORRIDA (0,80x0,25) (ml)',
            'CIMIENTO CORRIDO DE H° DE CASCOTE (m3)',
            'VIGA FUNDACION (20x20) (ml)',
            'VIGA FUNDACION (20x30) (ml)',
            'PILOTINES (Diam.: 25cm) (ml)',
            'TABIQUE DE CANTO (m2)',
            'PARED LADRILLO COMUN DE 15 (m2)',
            'PARED LADRILLO COMUN DE 20 (m2)',
            'PARED LADRILLO COMUN DE 30 (m2)',
            'TABIQUE LADRILLO HUECO DE 8 (m2)',
            'TABIQUE LADRILLO HUECO DE 10 (m2)',
            'TABIQUE LADRILLO HUECO DE 12 (m2)',
            'PARED LADRILLO HUECO DE 20 (m2)',
            'PARED BLOQUE CERAM. 12x19x33 (m2)',
            'PARED BLOQUE CERAM. 18x19x33 (m2)',
            'PARED LADRILLO HUECO DE 12 (m2)',
            'TABIQUE BLOQUE H° DE 10 (m2)',
            'DINTEL (20x20) P/ PARED DE 20 (ml)',
            'BLOQUE H° DE 20 (m2)',
            'CAPA AISLADORA. Esp.: 2cm (m2)',
            'E.H I & S (15x15) P/ PARED DE 15 (ml)',
            'E.H I & S (15x20) P/ PARED DE 20 (ml)',
            'E.V P/ PARED DE 15 (ml)',
            'E.V P/ PARED DE 20 (ml)',
            'HORMIGON ARMADO (m3) H13',
            'HORMIGON ARMADO (m3) H17',
            'HORMIGON ARMADO (m3) H21',
            'HORMIGON ARMADO (m3) H25',
            'HORMIGON ARMADO (m3) H30',
            'CONTRAPISO (m3)',
            'CARPETA HIDROFUGA. Esp.: 2cm (m2)',
            'ALISADO DE CEMENTO P/PISO. Esp.: 2cm (m2)',
            'COLOC. MOSAICO/BALDOSA. Esp.: 2.5cm (m2)',
            'AZOTADO HIDROFUGO BAJO REV. (m2)',
            'REVOQUE GRUESO. Esp.: 1.5cm (m2)',
            'REVOQUE FINO. Esp.: 0.5cm (m2)',
            'COLUMNAS 20x20 - Estr. c/ 15cm (ml)',
            'VIGAS 20x20 - Estr. c/ 20cm (ml)',
            'CARGA CUBIERTA (completa) (m3)',
            'DINTELES (20x20) P/ PARED DE 20 (ml)',
            'REVESTIMIENTO MICROCEMENTO (m2) QUIMTEX',
            'COLOR MICROCEMENTO (kg) TERSUAVE',
            'FIJADOR (m2)',
            'LATEX INTERIOR (m2)',
            'LATEX EXTERIOR (m2)',
            'MEMBRANA LIQUIDA (m2)',
            'SIKAFLEX 1A PLUS (ml) JUNTA DE 1X1cm',
            'SIKAFLEX 1A PLUS (ml) JUNTA DE 0,5x0,5cm',
            'SIKAFLEX 1A PLUS (ml) JUNTA DE 0,25x0,25cm',
            'SIKAFLEX 1A PLUS (ml) JUNTA DE 0,125x0,125cm',
            'VIGA O COLUMNA (ml)',
            'VIGA O COLUMNAS H° IN SITU',
            'VIGA O COLUMNA (ml)',
        ];

        foreach ($typeTask as $typeTask) {
            TypeTask::create([
                'name' => $typeTask,
            ]);
        }
    }
}
