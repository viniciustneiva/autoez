<?php

namespace Tests\Feature;

use App\Http\Controllers\VeiculoController;
use App\Models\Aluguel;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Gerente;
use App\Models\Marca;
use App\Models\TipoFuncionario;
use App\Models\User;
use App\Models\Veiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use function PHPUnit\Framework\assertNotNull;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_logged_in_can_acess_funcionarios_list()
    {
        $response = $this->get('/funcionarios')
            ->assertRedirect('/login');
    }

    public function test_only_logged_in_can_create_funcionarios()
    {
        $response = $this->get('/funcionario/editar')
            ->assertRedirect('/login');
    }

    public function test_models_can_be_instantiated()
    {
        $user = User::factory()->create();
        $this->assertModelExists($user);
    }

    public function test_logged_clientes_list()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/clientes');

        $response->assertStatus(200);

    }

    public function test_logged_veiculos_list()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/veiculos');

        $response->assertStatus(200);
    }

    public function test_logged_funcionarios_list()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/funcionarios');
        if(TipoFuncionario::ehGerente()){
            $response->assertStatus(200);
        }else if(TipoFuncionario::ehFuncionario()) {
            $response->assertStatus(302);
        }
    }

    public function test_only_gerentes_can_create_funcionario()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/funcionario/editar');
        if(TipoFuncionario::ehGerente()){
            $response->assertStatus(200);
        }else if(TipoFuncionario::ehFuncionario()) {
            $response->assertStatus(302);
        }
    }

    public function test_logged_alugueis_list()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/alugueis');

        $response->assertStatus(200);

    }

    public function test_only_logged_user_can_create_aluguel()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/aluguel/editar');

        $response->assertStatus(200);

    }

    public function test_only_gerente_can_acess_each_other()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/gerentes');
        if(TipoFuncionario::ehGerente()){
            $response->assertStatus(200);
        }else if(TipoFuncionario::ehFuncionario()) {
            $response->assertStatus(302);
        }

    }

    public function test_only_gerente_can_edit_each_other()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/gerente/editar');
        if(TipoFuncionario::ehGerente()){
            $response->assertStatus(200);
        }else if(TipoFuncionario::ehFuncionario()) {
            $response->assertStatus(302);
        }
    }

    public function test_only_gerentes_can_access_relatorio_aluguel()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/relatorio-aluguel');
        if(TipoFuncionario::ehGerente()){
            $response->assertStatus(200);
        }else if(TipoFuncionario::ehFuncionario()) {
            $response->assertStatus(302);
        }
    }

    public function test_only_gerentes_can_access_relatorio_clientes()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/relatorio-cliente');
        if(TipoFuncionario::ehGerente()){
            $response->assertStatus(200);
        }else if(TipoFuncionario::ehFuncionario()) {
            $response->assertStatus(302);
        }
    }

    public function test_only_gerentes_can_access_relatorio_veiculo()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get('/relatorio-veiculo');
        if(TipoFuncionario::ehGerente()){
            $response->assertStatus(200);
        }else if(TipoFuncionario::ehFuncionario()) {
            $response->assertStatus(302);
        }
    }

    public function test_gerar_relatorio_veiculo() {
        if(Marca::count() > 0 && Aluguel::count() > 0 && Cliente::count() > 0){
            $relatorio = Veiculo::gerarRelatorioVeiculo();
            $this->assertIsObject($relatorio);
            $this->assertNotNull($relatorio);
        }
    }

    public function test_get_gerente_id() {
        $user = User::factory()->create();

        $id = $user->id;
        $user->tipo = TipoFuncionario::$Gerente;
        $user->saveQuietly();
        $user2 = Gerente::getGerenteId($id);
        $this->assertIsObject($user2);
        $this->assertEquals($user2->id, $user->id);


    }

    public function test_listar_gerentes() {
        $gerentes = Gerente::listarGerentes();

        $step = false;
        foreach ($gerentes as $g) {
            $this->assertFalse($g->tipo != TipoFuncionario::$Gerente);
        }
        $step = true;

        $this->assertTrue($step);
        $this->assertIsObject($gerentes);
        $this->assertNotNull($gerentes);
    }

    public function test_get_cliente_id() {
        $cliente = Cliente::factory()->create();

        $id = $cliente->id;

        $cliente2 = Cliente::getClienteId($id);

        $this->assertEquals($cliente2->id, $cliente->id);

        $this->assertFalse($cliente->id != $cliente2->id);
    }

    public function test_tipos_relation() {
        $user = User::find(1)->tipos;

        $raw = User::where('id', 1)->first()->tipo;

        $this->assertIsObject($user);
        $this->assertIsInt($user->id);

        $this->assertEquals($raw, $user->id);

        $this->assertFalse($raw !== $user->id);
    }

    public function test_listar_funcionarios() {
        $lista = User::listarFuncionarios();

        $this->assertIsObject($lista);

        foreach ($lista as $item) {
            $this->assertTrue($item->tipo === TipoFuncionario::$Funcionario);
            $this->assertFalse($item->tipo !== TipoFuncionario::$Funcionario);
        }
    }

    public function test_get_funcionario_by_id() {
        $fakeId = fake()->numberBetween(1, 100);

        $resultado = User::getFuncionarioId($fakeId);
        if($resultado) {
            $this->assertTrue($resultado->tipo == TipoFuncionario::$Funcionario);

            $this->assertFalse($resultado->tipo == TipoFuncionario::$Gerente);
        }


        $this->assertTrue(User::where('id', $fakeId)->where('tipo', TipoFuncionario::$Funcionario)->first() ==  $resultado);
    }

    public function test_lista_estados() {
        $lista = Estado::getEstados();
        $this->assertIsArray($lista);
        $this->assertNotNull($lista);
    }

    public function test_get_marca_id() {
        $marca = Marca::first();

        $id = $marca->id;

        $marca2 = Marca::getMarcaId($id);

        $this->assertEquals($marca2->id, $marca->id);

        $this->assertFalse($marca2->id != $marca->id);
    }

}
