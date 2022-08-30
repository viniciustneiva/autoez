<?php

namespace Tests\Feature;

use App\Http\Controllers\VeiculoController;
use App\Models\Veiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VeiculoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_logged_in_can_acess_veiculos_list()
    {
        $response = $this->get('/veiculos')
            ->assertRedirect('/login');
    }

    public function test_only_logged_in_can_create_veiculos()
    {
        $response = $this->get('/veiculo/editar')
            ->assertRedirect('/login');
    }

    public function test_models_can_be_instantiated()
    {
        $veiculo = Veiculo::factory()->create();
        $this->assertModelExists($veiculo);
    }

    public function test_edit_veiculo() {
        $veiculoController = new VeiculoController();

        $veiculoController = $veiculoController->editarVeiculo();
        $this->assertIsObject($veiculoController);
    }

    public function test_emprestar_veiculo() {
        $veiculo = Veiculo::factory()->create();
        $id = $veiculo->id;
        $this->assertTrue(Veiculo::emprestarVeiculo($id));

        $this->assertFalse(Veiculo::emprestarVeiculo($id) && Veiculo::where('disponivel', 1)->count() == 0);
    }

    public function test_devolver_veiculo() {
        $veiculo = Veiculo::where('disponivel', 0)->get()->first();

        if($veiculo){
            $id = $veiculo->id;
            $funcao = Veiculo::devolverVeiculo($id);
            $this->assertIsBool($funcao);
            $this->assertTrue($funcao);
        }else{
            $this->assertFalse(Veiculo::where('disponivel', 0)->count() == 0);
        }
    }

    public function test_get_veiculo_id() {
        $veiculo = Veiculo::factory()->create();

        $id = $veiculo->id;

        $veiculo2 = Veiculo::getVeiculoId($id);

        $this->assertEquals($veiculo2->id, $veiculo->id);
        $this->assertIsObject($veiculo2);

    }

    public function test_get_veiculos_disponiveis() {
        $veiculos = Veiculo::getVeiculosDisponiveis();

        $this->assertCount(Veiculo::where('disponivel', 1)->count(), $veiculos);
        if(Veiculo::where('disponivel', 1)->count() > 0) {
            $this->assertNotEmpty($veiculos);
            $this->assertNotNull($veiculos);
        }
        $this->assertIsArray($veiculos);
    }

    public function test_get_lista_veiculos() {
        $veiculos = Veiculo::getVeiculos();

        $this->assertIsArray($veiculos);

        foreach ($veiculos as $v) {
            $this->assertIsString($v);
        }
    }


}

