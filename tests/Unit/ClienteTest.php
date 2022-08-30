<?php

namespace Tests\Unit;

use App\Models\Cliente;
use PHPUnit\Framework\TestCase;

class ClienteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_if_aluguel_columns_is_correct() {
        $cliente = new Cliente;

        $expected = [
            'email',
            'name',
            'cpf',
            'cep',
            'rua',
            'numero',
            'complemento',
            'bairro',
            'cidade',
            'estado',
            'telefone',
            'data_nascimento',
        ];

        $arrayComp = array_diff($expected, $cliente->getFillable());

        $this->assertCount(0, $arrayComp);
    }
}
