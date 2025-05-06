<?php

namespace Database\Seeders;

use App\Models\Contractor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContractorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contractor::factory(10)->create();
    }
}
