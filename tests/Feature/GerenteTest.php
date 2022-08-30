<?php

namespace Tests\Feature;

use App\Http\Controllers\GerenteController;
use App\Http\Controllers\HomeController;
use App\Models\Cliente;
use App\Models\TipoFuncionario;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GerenteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_logged_in_can_acess_gerentes_list()
    {
        $response = $this->get('/gerentes')
            ->assertRedirect('/login');
    }

    public function test_only_logged_in_can_create_gerentes()
    {
        $response = $this->get('/gerente/editar')
            ->assertRedirect('/login');
    }

    public function test_listar_gerentes() {
        $controller = new GerenteController();

        $controller = $controller->listarGerentes();
        $this->assertIsObject($controller);
    }

    public function test_listar_funcionarios() {
        $controller = new GerenteController();

        $controller = $controller->listarFuncionarios();
        $this->assertIsObject($controller);
    }

    public function test_editar_gerentes() {
        $controller = new GerenteController();

        $controller = $controller->editarGerente();
        $this->assertIsObject($controller);

    }

    public function test_editar_funcionario() {
        $controller = new GerenteController();

        $controller = $controller->editarFuncionario();
        $this->assertIsObject($controller);
    }

    public function test_call_gerar_relatorio_aluguel() {
        $controller = new GerenteController();

        $controller = $controller->gerarRelatorioAluguel();
        $this->assertIsObject($controller);

    }

    public function test_call_gerar_relatorio_veiculo() {
        $controller = new GerenteController();

        $controller = $controller->gerarRelatorioVeiculo();
        $this->assertIsObject($controller);

    }

    public function test_call_gerar_relatorio_cliente() {
        $controller = new GerenteController();

        $controller = $controller->gerarRelatorioCliente();
        $this->assertIsObject($controller);

    }

    public function test_call_deletar_funcionario() {
        $controller = new GerenteController();
        $funcionario = User::where('tipo', TipoFuncionario::$Funcionario)->first();
        $controller = $controller->deletarFuncionario($funcionario->id);
        $this->assertIsObject($controller);
        $aux = User::find($funcionario->id);
        $this->assertTrue($aux === null);
    }

    public function test_call_deletar_cliente() {
        $controller = new GerenteController();
        $cliente = Cliente::first();
        $controller = $controller->deletarCliente($cliente->id);
        $this->assertIsObject($controller);
        $aux = Cliente::find($cliente->id);
        $this->assertTrue($aux === null);
    }

    public function test_deletar_gerente() {
        $controller = new GerenteController();
        $gerente = User::where('tipo', TipoFuncionario::$Gerente)->whereNot('id', 1)->first();
        $controller = $controller->deletarGerente($gerente->id);
        $this->assertIsObject($controller);
        $aux = User::find($gerente->id);
        $this->assertTrue($aux === null);
    }

    public function test_only_logged_in_can_access_homepage() {
        $response = $this->get('/home')
            ->assertRedirect('/login');
    }

    public function test_object_homepage() {
        $controller = new HomeController();

        $controller = $controller->index();
        $this->assertIsObject($controller);
    }
}
