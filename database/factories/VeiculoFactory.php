<?php

namespace Database\Factories;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Veiculo>
 */
class VeiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('pt_BR');
        return [
            'marca_id' => $this->faker->randomElement(Marca::pluck('id')),
            'placa' => fake()->bothify('???-#?##'),
            'modelo' => fake()->word(),
            'cor' => fake()->word(),
            'ano' => fake()->year(),
            'valor' => "R$ " . fake()->numberBetween('30000', '350000'),
        ];
    }
}
