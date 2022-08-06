<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
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
            'name' => $faker->name(),
            'email' => fake()->safeEmail(),
            'cpf' => $faker->cpf,
            'rua' => 'Praça Sete de Setembro',
            'numero' => fake()->numerify(),
            'bairro' => 'Centro',
            'cidade' => 'Belo Horizonte',
            'estado' => 'MG',
            'telefone' => fake()->phoneNumber(),
            'cep' => fake()->postcode(),
            'data_nascimento' => fake()->date(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
