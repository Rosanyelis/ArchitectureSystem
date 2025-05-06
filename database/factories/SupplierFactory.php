<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'razon_social' => $this->faker->company(),
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'cuit_del_proveedor' => $this->faker->unique()->numerify('20#########'),
            'telefono' => $this->faker->phoneNumber(),
            'correo_electronico' => $this->faker->email(),
            'domicilio' => $this->faker->address(),
            'localidad' => $this->faker->city(),
            'provincia' => $this->faker->state(),
        ];
    }
}
