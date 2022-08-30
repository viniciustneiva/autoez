<?php

namespace Tests\Unit;

use App\Models\Aluguel;
use PHPUnit\Framework\TestCase;

class AluguelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_if_aluguel_columns_is_correct() {
        $aluguel = new Aluguel;

        $expected = [
            'cliente_id',
            'funcionario_id',
            'veiculo_id',
            'data_emprestimo',
            'prazo',
            'data_entrega',
            'entregue',
        ];

        $arrayComp = array_diff($expected, $aluguel->getFillable());

        $this->assertCount(0, $arrayComp);
    }
}
