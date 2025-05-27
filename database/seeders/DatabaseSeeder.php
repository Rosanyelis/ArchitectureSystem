<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            MaterialSeeder::class,
            UnitSeeder::class,
            TypeTaskSeeder::class,
            TypeTaskMaterialSeeder::class,
            CurrencySeeder::class,
            DollarRateSeeder::class,
            PaymentMethodSeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,
            ContractorSeeder::class,
            RoleSeeder::class,
        ]);

        $usuario = User::factory()->create([
            'name' => 'Administrador',
            'email' => 'administrador@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $usuario->assignRole('Administrador');
    }
}
