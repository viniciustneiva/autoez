<?php

namespace Tests\Feature;

use App\Http\Controllers\AluguelController;
use App\Models\Aluguel;
use App\Models\Cliente;
use App\Models\Marca;
use App\Models\TipoFuncionario;
use App\Models\Veiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlugueisTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /* @test*/
    public function test_only_logged_in_users_can_see_alugueis_list()
    {
        $response = $this->get('/alugueis')
            ->assertRedirect('/login');
    }

    public function test_models_can_be_instantiated()
    {
        $aluguel = Aluguel::factory()->create();
        $this->assertModelExists($aluguel);
        $this->assertIsObject($aluguel);
    }

    public function test_get_aluguel_id() {
        $aluguel = Aluguel::factory()->create();

        $id = $aluguel->id;

        $aluguel2 = Aluguel::getAluguel($id);

        $this->assertIsInt($id);

        $this->assertEquals($aluguel2->id, $aluguel->id);

        $this->assertFalse($aluguel2->id !== $aluguel->id);
    }

    public function test_delete_aluguel() {
        $aluguel = Aluguel::factory()->create();

        $id = $aluguel->id;

        $resultado = Aluguel::deletarAluguel($id);

        $this->assertIsBool($resultado);

        $this->assertTrue($resultado && $aluguel->entregue == 1);

        $this->assertFalse($resultado === true && ($aluguel->data_entrega === null || $aluguel->entregue === 0));

        $aux = Aluguel::where('id', $id)->first();

        $this->assertTrue( $aux === null);

    }

    public function test_gerar_relatorio_aluguel() {
        if(Marca::count() > 0 && Aluguel::count() > 0 && Cliente::count() > 0){
            $relatorio = Aluguel::gerarRelatorio();
            $this->assertIsObject($relatorio);
            $this->assertNotNull($relatorio);
        }
    }

    public function test_call_listar_alugueis() {
        $controller = new AluguelController();

        $controller = $controller->listarAlugueis();
        $this->assertIsObject($controller);
        $this->assertNotEmpty($controller);
        $this->assertNotNull($controller);
    }

    public function test_edit_aluguel() {
        $controller = new AluguelController();

        $controller = $controller->editarAluguel();
        $this->assertIsObject($controller);
    }

    public function test_call_deletar_aluguel() {

        $aluguel = Aluguel::first();
        $idAluguel = $aluguel->id;
        $controller = new AluguelController();
        $this->assertIsObject($aluguel);
        $this->assertIsObject($controller);
        if(TipoFuncionario::ehGerente()){
            $controller = $controller->deletarAluguel($idAluguel);
            $aux = Aluguel::find($idAluguel);
            $this->assertNull($aux);
        }else{
            $aux = Aluguel::find($idAluguel);
            $this->assertNotNull($aux);
        }

    }

}
