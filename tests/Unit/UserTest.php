<?php

namespace Tests\Unit;

use App\Models\Marca;
use App\Models\User;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_if_user_columns_is_correct() {
        $user = new User;

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
            'password',
            'tipo'
        ];

        $arrayComp = array_diff($expected, $user->getFillable());

        $this->assertCount(0, $arrayComp);

    }




}
