<?php

namespace Tests\Unit;

use App\Models\Veiculo;
use PHPUnit\Framework\TestCase;

class VeiculoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_if_veiculo_columns_is_correct() {
        $veiculo = new Veiculo;

        $expected = [
            'placa',
            'marca_id',
            'modelo',
            'cor',
            'ano',
            'valor',
            'disponivel',
        ];

        $arrayComp = array_diff($expected, $veiculo->getFillable());

        $this->assertCount(0, $arrayComp);
    }
}
