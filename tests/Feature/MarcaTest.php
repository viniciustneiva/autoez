<?php

namespace Tests\Feature;

use App\Http\Controllers\MarcaController;
use App\Models\Marca;
use App\Models\TipoFuncionario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class MarcaTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_logged_in_can_acess_marcas_list()
    {
        $response = $this->get('/marcas')
            ->assertRedirect('/login');
    }

    public function test_only_logged_in_can_create_marcas()
    {
        $response = $this->get('/marcas/editar')
            ->assertRedirect('/login');
    }

    public function test_marca_creation() {

        $response = $this->call("POST", "/criar-marca", [
            'name' => "MARCA TESTE 123",
            "porcentagem" => 10.7
        ]);

        if(Auth::check()){
            $response->assertStatus(200);
        }else{
            $response->assertStatus(419);
        }

    }

    public function test_edit_marca() {
        $controller = new MarcaController();

        $controller = $controller->editarMarca();
        $this->assertIsObject($controller);
    }

    public function test_get_marcas() {
        $lista = Marca::getMarcas();
        $this->assertIsArray($lista);
        $this->assertNotNull($lista);
    }

    public function test_listar_marcas() {
        $lista = Marca::listarMarcas();
        $this->assertIsObject($lista);
        $this->assertNotNull($lista);
    }

    public function test_deletar_marca() {

        $marca = Marca::first();
        $idMarca = $marca->id;
        $this->assertIsObject($marca);
        if(TipoFuncionario::ehGerente()){
            Marca::deletarMarca($marca->id);
            $aux = Marca::find($idMarca);
            $this->assertTrue($aux === null);
        }

    }

    public function test_call_listar_marcas() {
        $controller = new MarcaController();

        $controller = $controller->listarMarcas();
        $this->assertIsObject($controller);
        $this->assertNotEmpty($controller);
        $this->assertNotNull($controller);
    }

}
