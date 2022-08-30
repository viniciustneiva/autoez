<?php

namespace Tests\Unit;

use App\Http\Requests\EditAluguelRequest;
use App\Http\Requests\EditClienteRequest;
use App\Http\Requests\EditFuncionarioRequest;
use App\Http\Requests\EditMarcaRequest;
use App\Http\Requests\EditVeiculoRequest;
use App\Http\Requests\StoreAluguelRequest;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\StoreFuncionarioRequest;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\StoreVeiculoRequest;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function test_always_authorize_store_veiculo_request()
    {

        $request = new StoreVeiculoRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_rules_from_store_veiculo_request()
    {

        $request = new StoreVeiculoRequest();

        $this->assertIsArray($request->rules());
    }

    public function test_always_authorize_store_marca_request()
    {

        $request = new StoreMarcaRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_rules_from_store_marca_request()
    {

        $request = new StoreMarcaRequest();

        $this->assertIsArray($request->rules());
    }

    public function test_always_authorize_store_funcionario_request()
    {

        $request = new StoreFuncionarioRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_rules_from_store_funcionario_request()
    {

        $request = new StoreFuncionarioRequest();

        $this->assertIsArray($request->rules());
    }

    public function test_always_authorize_store_cliente_request()
    {

        $request = new StoreClienteRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_rules_from_store_cliente_request()
    {

        $request = new StoreClienteRequest();

        $this->assertIsArray($request->rules());
    }

    public function test_always_authorize_store_aluguel_request()
    {

        $request = new StoreAluguelRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_rules_from_store_aluguel_request()
    {

        $request = new StoreAluguelRequest();

        $this->assertIsArray($request->rules());
    }

    public function test_always_authorize_edit_aluguel_request()
    {

        $request = new EditAluguelRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_rules_from_edit_aluguel_request()
    {

        $request = new EditAluguelRequest();

        $this->assertIsArray($request->rules());
    }

    public function test_always_authorize_edit_veiculo_request()
    {

        $request = new EditVeiculoRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_rules_from_edit_veiculo_request()
    {

        $request = new EditVeiculoRequest();

        $this->assertIsArray($request->rules());
    }

    public function test_always_authorize_edit_marca_request()
    {

        $request = new EditMarcaRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_rules_from_edit_marca_request()
    {

        $request = new EditMarcaRequest();

        $this->assertIsArray($request->rules());
    }

    public function test_always_authorize_edit_funcionario_request()
    {

        $request = new EditFuncionarioRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_rules_from_edit_funcionario_request()
    {

        $request = new EditFuncionarioRequest();

        $this->assertIsArray($request->rules());
    }

    public function test_always_authorize_edit_cliente_request()
    {

        $request = new EditClienteRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_rules_from_edit_cliente_request()
    {

        $request = new EditClienteRequest();

        $this->assertIsArray($request->rules());
    }


}
