<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\Material;
use App\Models\TypeTask;
use Illuminate\Database\Seeder;
use App\Models\TypeTaskMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeTaskMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # ZAPATA CORRIDA (0,80x0,25) (ml)
            $typeTask = TypeTask::where('name', 'ZAPATA CORRIDA (0,80x0,25) (ml)')->first();
            # Cemento
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '1',
                'quantity' => '60',
            ]);
            # Arena
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '3',
                'quantity' => '0.13',
            ]);
            # Piedra 1/3
            $material = Material::where('name', 'Piedra 1/3')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '3',
                'quantity' => '0.13',
            ]);
            # Hierro 10/12
            $material = Material::where('name', 'Hierro 10/12')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '12',
            ]);
            # hierro 6/8
            $material = Material::where('name', 'Hierro 6/8')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '15',
            ]);
            # alambre atar
            $material = Material::where('name', 'Alambre atar')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.2',
            ]);


        # CIMIENTO CORRIDO DE H° DE CASCOTE (m3)    
            $typeTask = TypeTask::where('name', 'CIMIENTO CORRIDO DE H° DE CASCOTE (m3)')->first();
            # Cal
            $material = Material::where('name', 'Cal')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '1',
                'quantity' => '81',
            ]);

            # Cemento
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();

            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '1/4',
                'quantity' => '38.4',
            ]);

            # Arena
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '3',
                'quantity' => '0.515',
            ]);

            # cascote
            $material = Material::where('name', 'Cascote')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '6',
                'quantity' => '0.77',
            ]);

        # VIGA FUNDACION (20x20) (ml)
            $typeTask = TypeTask::where('name', 'VIGA FUNDACION (20x20) (ml)')->first();
            # Cemento
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '1',
                'quantity' => '12',
            ]);

            # Arena 
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '3',
                'quantity' => '0.026',
            ]);

            # Piedra
            $material = Material::where('name', 'Piedra')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '3',
                'quantity' => '0.06',
            ]);

            # Hierro 8/10   
            $material = Material::where('name', 'Hierro 8/10')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '1.2',
            ]);

            # Hierro    4,2
            $material = Material::where('name', 'Hierro 4,2')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '3.5',
            ]);

            # Alambre atar  
            $material = Material::where('name', 'Alambre atar')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.15',
            ]);

        # VIGA FUNDACION (20x30) (ml)
            $typeTask = TypeTask::where('name', 'VIGA FUNDACION (20x30) (ml)')->first();
            # Cemento
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '1',
                'quantity' => '18',
            ]);

            # Arena
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '3',
                'quantity' => '0.039',
            ]);

            # Piedra
            $material = Material::where('name', 'Piedra')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '3',
                'quantity' => '0.09',
            ]);

            # Hierro 8/10
            $material = Material::where('name', 'Hierro 8/10')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '6',
            ]);

            # Hierro 4,2
            $material = Material::where('name', 'Hierro 4,2')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '5.25',
            ]);

            # Alambre atar
            $material = Material::where('name', 'Alambre atar')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.22',
            ]);

        # PILOTINES (Diam.: 25cm) (ml)  
            $typeTask = TypeTask::where('name', 'PILOTINES (Diam.: 25cm) (ml)')->first();
            # Cemento
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '1',
                'quantity' => '14.7',
            ]);

            # Arena
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '3',
                'quantity' => '0.032',
            ]);

            # Piedra 1/3
            $material = Material::where('name', 'Piedra 1/3')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => '3',
                'quantity' => '0.032',
            ]);

            # Hierro 10
            $material = Material::where('name', 'Hierro 10')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '5.5',
            ]);

            # Hierro 4,2
            $material = Material::where('name', 'Hierro 4,2')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '3.5',
            ]);

            # Alambre atar
            $material = Material::where('name', 'Alambre atar')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.12',
            ]);
        
        # TABIQUE DE CANTO (m2)
            $typeTask = TypeTask::where('name', 'TABIQUE DE CANTO (m2)')->first();
            # Cemento Alb.
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '2.2',
            ]);
            # Arena
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.012',
            ]);
            # Ladrillo común
            $material = Material::where('name', 'Ladrillo común')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '30',
            ]);

            # PARED LADRILLO COMÚN DE 15 (m2)
            $typeTask = TypeTask::where('name', 'PARED LADRILLO COMÚN DE 15 (m2)')->first();
            # Cemento Alb.
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '7.7',
            ]);
            # Arena
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.043',
            ]);
            # Ladrillo común
            $material = Material::where('name', 'Ladrillo común')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '60',
            ]);

        # PARED LADRILLO COMUN DE 20 (m2)
            $typeTask = TypeTask::where('name', 'PARED LADRILLO COMUN DE 20 (m2)')->first();
            # Cemento Alb.
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '10.9',
            ]);
            # Arena
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.08',
            ]);
            # Ladrillo común
            $material = Material::where('name', 'Ladrillo común')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '90',
            ]);

        // PARED LADRILLO COMUN DE 30 (m2)
            $typeTask = TypeTask::where('name', 'PARED LADRILLO COMUN DE 30 (m2)')->first();
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '15.2',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.115',
            ]);
            $material = Material::where('name', 'Ladrillo común')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '120',
            ]);

        // TABIQUE LADRILLO HUECO DE 8 (m2)
            $typeTask = TypeTask::where('name', 'TABIQUE LADRILLO HUECO DE 8 (m2)')->first();
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '3.5',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.016',
            ]);
            $material = Material::where('name', 'Ladrillo Hueco 8x18x33')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '16',
            ]);

        // PARED LADRILLO HUECO DE 12 (m2)
            $typeTask = TypeTask::where('name', 'PARED LADRILLO HUECO DE 12 (m2)')->first();
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '5.4',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.025',
            ]);
            $material = Material::where('name', 'Ladrillo Hueco 12x18x33')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '16',
            ]);

        // PARED BLOQUE CERÁM. 12x19x33 (m2)
            $typeTask = TypeTask::where('name', 'PARED BLOQUE CERAM. 12x19x33 (m2)')->first();
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '2.5',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.015',
            ]);
            $material = Material::where('name', 'Ladrillo hueco 8x18x33')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '12',
            ]);


        // PARED BLOQUE CERAM. 18x19x33 (m2)
            $typeTask = TypeTask::where('name', 'PARED BLOQUE CERAM. 18x19x33 (m2)')->first();
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '3',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.016',
            ]);
            $material = Material::where('name', 'Ladrillo hueco 8x18x33')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '12.5',
            ]);

        // TABIQUE BLOQUE H° DE 10 (m2)
            $typeTask = TypeTask::where('name', 'TABIQUE BLOQUE H° DE 10 (m2)')->first();
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '5',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.011',
            ]);
            $material = Material::where('name', 'Ladrillo H° 9x19x39')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '12.5',
            ]);

        // BLOQUE H° DE 20 (m2)
            $typeTask = TypeTask::where('name', 'BLOQUE H° DE 20 (m2)')->first();
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '4.75',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.013',
            ]);
            $material = Material::where('name', 'Ladrillo H° 19x19x39')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '12.5',
            ]);

        // CAPA AISLADORA. Esp.: 2cm (m2)
            $typeTask = TypeTask::where('name', 'CAPA AISLADORA. Esp.: 2cm (m2)')->first();
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '10.8',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.024',
            ]);
            $material = Material::where('name', 'Hidrófugo')->first();
            $unit = Unit::where('abbreviation', 'lts')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.3',
            ]);
            $material = Material::where('name', 'Pintura asf.')->first();
            $unit = Unit::where('abbreviation', 'lts')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.3',
            ]);

        // E.H I & S (15x15) P/ PARED DE 15 (ml)
        $typeTask = TypeTask::where('name', 'E.H I & S (15x15) P/ PARED DE 15 (ml)')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '6.75',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.015',
        ]);
        $material = Material::where('name', 'Piedra 1/3')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.015',
        ]);
        $material = Material::where('name', 'Hierro 8/10')->first();
        $unit = Unit::where('abbreviation', 'm')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '4',
        ]);
        $material = Material::where('name', 'Hierro 4,2')->first();
        $unit = Unit::where('abbreviation', 'm')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '2.5',
        ]);

        // E.H I & S (15x20) P/ PARED DE 20 (ml)
        $typeTask = TypeTask::where('name', 'E.H I & S (15x20) P/ PARED DE 20 (ml)')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '9',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.02',
        ]);
        $material = Material::where('name', 'Piedra 1/3')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.02',
        ]);
        $material = Material::where('name', 'Hierro 8/10')->first();
        $unit = Unit::where('abbreviation', 'm')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '4',
        ]);
        $material = Material::where('name', 'Hierro 4,2')->first();
        $unit = Unit::where('abbreviation', 'm')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '3',
        ]);

        // E.V P/ PARED DE 15 (ml)
        $typeTask = TypeTask::where('name', 'E.V P/ PARED DE 15 (ml)')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '7.5',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.016',
        ]);
        $material = Material::where('name', 'Piedra 1/3')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.016',
        ]);
        $material = Material::where('name', 'Hierro 8/10')->first();
        $unit = Unit::where('abbreviation', 'm')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '6',
        ]);
        $material = Material::where('name', 'Hierro 4,2')->first();
        $unit = Unit::where('abbreviation', 'm')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '3',
        ]);

        // E.V P/ PARED DE 20 (ml)
        $typeTask = TypeTask::where('name', 'E.V P/ PARED DE 20 (ml)')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '9',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.02',
        ]);
        $material = Material::where('name', 'Piedra 1/3')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.02',
        ]);
        $material = Material::where('name', 'Hierro 8/10')->first();
        $unit = Unit::where('abbreviation', 'm')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '4',
        ]);
        $material = Material::where('name', 'Hierro 4,2')->first();
        $unit = Unit::where('abbreviation', 'm')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '4',
        ]);

        // HORMIGÓN ARMADO (m3) H13
        $typeTask = TypeTask::where('name', 'HORMIGÓN ARMADO (m3) H13')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '260',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.65',
        ]);
        $material = Material::where('name', 'Piedra 1/3')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.65',
        ]);

        // HORMIGÓN ARMADO (m3) H17
        $typeTask = TypeTask::where('name', 'HORMIGÓN ARMADO (m3) H17')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '300',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.65',
        ]);
        $material = Material::where('name', 'Piedra 1/3')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.65',
        ]);

        // HORMIGÓN ARMADO (m3) H21
        $typeTask = TypeTask::where('name', 'HORMIGÓN ARMADO (m3) H21')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '340',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.65',
        ]);
        $material = Material::where('name', 'Piedra 1/3')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.65',
        ]);

        // HORMIGÓN ARMADO (m3) H25
        $typeTask = TypeTask::where('name', 'HORMIGÓN ARMADO (m3) H25')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '360',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.65',
        ]);
        $material = Material::where('name', 'Piedra 1/3')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.65',
        ]);

        // HORMIGÓN ARMADO (m3) H30
        $typeTask = TypeTask::where('name', 'HORMIGÓN ARMADO (m3) H30')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '380',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.65',
        ]);
        $material = Material::where('name', 'Piedra 1/3')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.65',
        ]);

        // CONTRAPISO (m3)
        $typeTask = TypeTask::where('name', 'CONTRAPISO (m3)')->first();
        $material = Material::where('name', 'Cemento Alb.')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '105',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.45',
        ]);
        $material = Material::where('name', 'Cascote')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.9',
        ]);

        // CARPETA HIDRÓFUGA. Esp.: 2cm (m2)
        $typeTask = TypeTask::where('name', 'CARPETA HIDRÓFUGA. Esp.: 2cm (m2)')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '10.8',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.024',
        ]);
        $material = Material::where('name', 'Hidrófugo')->first();
        $unit = Unit::where('abbreviation', 'lts')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.3',
        ]);

        // ALISADO DE CEMENTO P/PISO. Esp.: 2cm (m2)
        $typeTask = TypeTask::where('name', 'ALISADO DE CEMENTO P/PISO. Esp.: 2cm (m2)')->first();
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '10.8',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.024',
        ]);

        // COLOC. MOSAICO/BALDOSA. Esp.: 2.5cm (m2)
        $typeTask = TypeTask::where('name', 'COLOC. MOSAICO/BALDOSA. Esp.: 2.5cm (m2)')->first();
        $material = Material::where('name', 'Cal')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '5.9',
        ]);
        $material = Material::where('name', 'Cemento')->first();
        $unit = Unit::where('abbreviation', 'kg')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '3.1',
        ]);
        $material = Material::where('name', 'Arena')->first();
        $unit = Unit::where('abbreviation', 'm3')->first();
        TypeTaskMaterial::create([
            'type_task_id' => $typeTask->id,
            'material_id' => $material->id,
            'unit_id' => $unit->id,
            'quantity_unit' => null,
            'quantity' => '0.03',
        ]);

        // AZOTADO HIDRÓFUGO BAJO REV. (m2)
            $typeTask = TypeTask::where('name', 'AZOTADO HIDRÓFUGO BAJO REV. (m2)')->first();
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '2.7',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.006',
            ]);
            $material = Material::where('name', 'Hidrófugo')->first();
            $unit = Unit::where('abbreviation', 'lts')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.4',
            ]);

        // REVOQUE GRUESO. Esp.: 1.5cm (m2)
            $typeTask = TypeTask::where('name', 'REVOQUE GRUESO. Esp.: 1.5cm (m2)')->first();
            $material = Material::where('name', 'Cal')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '3.6',
            ]);
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '1.85',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.017',
            ]);

        // REVOQUE FINO. Esp.: 0.5cm (m2)
            $typeTask = TypeTask::where('name', 'REVOQUE FINO. Esp.: 0.5cm (m2)')->first();
            $material = Material::where('name', 'Cal')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '1.6',
            ]);
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.45',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.006',
            ]);

        // COLUMNAS 20x20 - Estr. c/ 15cm (ml)
            $typeTask = TypeTask::where('name', 'COLUMNAS 20x20 - Estr. c/ 15cm (ml)')->first();
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '12',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.026',
            ]);
            $material = Material::where('name', 'Piedra 1/3')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.026',
            ]);
            $material = Material::where('name', 'Hierro 8/10')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '6',
            ]);
            $material = Material::where('name', 'Hierro 4,2')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '1.2',
            ]);

        // VIGAS 20x20 - Estr. c/ 20cm (ml)
            $typeTask = TypeTask::where('name', 'VIGAS 20x20 - Estr. c/ 20cm (ml)')->first();
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '12',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.026',
            ]);
            $material = Material::where('name', 'Piedra 1/3')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.026',
            ]);
            $material = Material::where('name', 'Hierro 8/10')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '6',
            ]);
            $material = Material::where('name', 'Hierro 4,2')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '4',
            ]);

        // CARGA CUBIERTA (completa) (m3)
            $typeTask = TypeTask::where('name', 'CARGA CUBIERTA (completa) (m3)')->first();
            $material = Material::where('name', 'Cemento Alb.')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '80',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.45',
            ]);
            $material = Material::where('name', 'Poliestireno exp. mol.')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '2',
            ]);
            $material = Material::where('name', 'Tejuela ladrillo comun')->first();
            $unit = Unit::where('abbreviation', 'u')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '33',
            ]);
            $material = Material::where('name', 'Pintura asf.')->first();
            $unit = Unit::where('abbreviation', 'lts')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.5',
            ]);
            $material = Material::where('name', 'Pegamento impermeable')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '5.5',
            ]);

        // DINTEL (20x20) P/ PARED DE 20 (ml)
            $typeTask = TypeTask::where('name', 'DINTEL (20x20) P/ PARED DE 20 (ml)')->first();
            $material = Material::where('name', 'Cemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '9',
            ]);
            $material = Material::where('name', 'Arena')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.02',
            ]);
            $material = Material::where('name', 'Piedra 1/3')->first();
            $unit = Unit::where('abbreviation', 'm3')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.02',
            ]);
            $material = Material::where('name', 'Hierro 8')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '4',
            ]);
            $material = Material::where('name', 'Hierro 4,2')->first();
            $unit = Unit::where('abbreviation', 'm')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '3',
            ]);

        // REVESTIMIENTO MICROCEEMENTO (m2) QUIMTEX
            $typeTask = TypeTask::where('name', 'REVESTIMIENTO MICROCEMENTO (m2) QUIMTEX')->first();
            $material = Material::where('name', 'Laca al agua')->first();
            $unit = Unit::where('abbreviation', 'lts')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.2',
            ]);
            $material = Material::where('name', 'Microcemento')->first();
            $unit = Unit::where('abbreviation', 'kg')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.75',
            ]);

        // COLOR MICROCEEMENTO (kg) TERSUAVE
            $typeTask = TypeTask::where('name', 'COLOR MICROCEMENTO (kg) TERSUAVE')->first();
            $material = Material::where('name', 'Pintura')->first();
            $unit = Unit::where('abbreviation', 'lts')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '0.74',
            ]);

        // FIJADOR (m2)
            $typeTask = TypeTask::where('name', 'FIJADOR (m2)')->first();
            $material = Material::where('name', 'Fijador al agua')->first();
            $unit = Unit::where('abbreviation', 'lts')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '20',
            ]);

        // LATEX INTERIOR (m2)
            $typeTask = TypeTask::where('name', 'LATEX INTERIOR (m2)')->first();
            $material = Material::where('name', 'Latex interior')->first();
            $unit = Unit::where('abbreviation', 'lts')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '10',
            ]);

        // LATEX EXTERIOR (m2)
            $typeTask = TypeTask::where('name', 'LATEX EXTERIOR (m2)')->first();
            $material = Material::where('name', 'Latex exterior')->first();
            $unit = Unit::where('abbreviation', 'lts')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '8',
            ]);

        // MEMBRANA LIQUIDA (m2)
            $typeTask = TypeTask::where('name', 'MEMBRANA LIQUIDA (m2)')->first();
            $material = Material::where('name', 'Membrana')->first();
            $unit = Unit::where('abbreviation', 'lts')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '1',
            ]);

        // SIKAFLEX 1A PLUS (ml) JUNTA DE 1X1cm
            $typeTask = TypeTask::where('name', 'SIKAFLEX 1A PLUS (ml) JUNTA DE 1X1cm')->first();
            $material = Material::where('name', 'Cartucho 300ml')->first();
            $unit = Unit::where('abbreviation', 'ml')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '3',
            ]);

        // SIKAFLEX 1A PLUS (ml) JUNTA DE 0,5x0,5cm
            $typeTask = TypeTask::where('name', 'SIKAFLEX 1A PLUS (ml) JUNTA DE 0,5x0,5cm')->first();
            $material = Material::where('name', 'Cartucho 300ml')->first();
            $unit = Unit::where('abbreviation', 'ml')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '6',
            ]);

        // SIKAFLEX 1A PLUS (ml) JUNTA DE 0,25x0,25cm
            $typeTask = TypeTask::where('name', 'SIKAFLEX 1A PLUS (ml) JUNTA DE 0,25x0,25cm')->first();
            $material = Material::where('name', 'Cartucho 300ml')->first();
            $unit = Unit::where('abbreviation', 'ml')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '12',
            ]);

        // SIKAFLEX 1A PLUS (ml) JUNTA DE 0,125x0,125cm
            $typeTask = TypeTask::where('name', 'SIKAFLEX 1A PLUS (ml) JUNTA DE 0,125x0,125cm')->first();
            $material = Material::where('name', 'Cartucho 300ml')->first();
            $unit = Unit::where('abbreviation', 'ml')->first();
            TypeTaskMaterial::create([
                'type_task_id' => $typeTask->id,
                'material_id' => $material->id,
                'unit_id' => $unit->id,
                'quantity_unit' => null,
                'quantity' => '24',
            ]);
    }
}
