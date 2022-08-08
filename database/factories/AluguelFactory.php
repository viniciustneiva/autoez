<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Marca;
use App\Models\User;
use App\Models\Veiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aluguel>
 */
class AluguelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'funcionario_id' => fake()->randomElement(User::pluck('id')),
            'veiculo_id' => fake()->randomElement(Veiculo::pluck('id')),
            'cliente_id' => fake()->randomElement(Cliente::pluck('id')),
            'prazo' => fake()->dateTimeInInterval('now', '+1 month'),
            'data_emprestimo' => fake()->dateTimeInInterval('-1 month', '+ 2 days'),
            'data_entrega' => fake()->dateTimeInInterval('now', 'now'),
            'entregue' => 1

        ];
    }
}
