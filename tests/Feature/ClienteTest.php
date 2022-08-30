<?php

namespace Tests\Feature;

use App\Http\Controllers\ClienteController;
use App\Models\Aluguel;
use App\Models\Cliente;
use App\Models\Marca;
use App\Models\Veiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_logged_in_can_acess_clientes_list()
    {
        $response = $this->get('/clientes')
            ->assertRedirect('/login');
    }

    public function test_clientes_are_created()
    {
        $qtd = DB::table('cliente')->count();

        $cliente = Cliente::factory()->count(1)->create();

        $this->assertDatabaseCount('cliente', $qtd+1);
        $this->assertIsObject($cliente);
        $this->assertNotNull($cliente);
    }

    public function test_models_can_be_instantiated()
    {
        $cliente = Cliente::factory()->create();
        $this->assertModelExists($cliente);
    }

    public function test_gerar_relatorio_cliente() {
        $relatorio = Cliente::gerarRelatorio();
        $this->assertIsObject($relatorio);
        if(Cliente::count() > 0){
            $this->assertNotEmpty($relatorio);
        }
    }

    public function test_editar_funcionario() {
        $controller = new ClienteController();

        $controller = $controller->editarCliente();
        $this->assertIsObject($controller);
    }

}
