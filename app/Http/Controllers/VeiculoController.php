<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditVeiculoRequest;
use App\Http\Requests\StoreVeiculoRequest;
use App\Models\TipoFuncionario;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Auth;


class VeiculoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function listarVeiculos() {
        $veiculos = Veiculo::listarVeiculo();
        return view('admin.veiculo.listar', ['veiculos' => $veiculos]);
    }

    public function editarVeiculo($id = null) {
        $veiculo = $id != null ? Veiculo::getVeiculoId($id) : null;
        $edicao = ($id != null);
        return view('admin.veiculo.editar', ['veiculo' => $veiculo, 'edicao' => $edicao]);
    }

    public function saveCreateVeiculo(StoreVeiculoRequest $request) {

        Veiculo::create([
            'placa' => $request->placa,
            'marca_id' => $request->marca_id,
            'modelo' => $request->modelo,
            'cor' => $request->cor,
            'ano' => $request->ano,
            'valor' => $request->valor
        ]);
        return redirect()->route('listarVeiculos')->with('success', 'Operação realizada com sucesso!');
    }

    public function saveEditVeiculo(EditVeiculoRequest $request) {
        //dd($request);
        Veiculo::where('id', $request->id)->update($request->except('_token'));

        return redirect()->route('listarVeiculos')->with('success', 'Operação realizada com sucesso!');
    }

    public function buscarVeiculo(Request $request) {
        if($request->validate(['placa' => 'required'])){
            return response()->json(Veiculo::with('marca')->where('placa', $request->placa)->first());
        }
        return null;
    }

    public function buscarVeiculoLike(Request $request) {
        if($request->validate(['placa' => 'required'])){
            return response()->json(Veiculo::with('marca')->where('placa', 'like', '%'.$request->placa.'%')->get());
        }
        return null;
    }

    public function deletarVeiculo($id) {
        $veiculo = Veiculo::find($id);

        if($veiculo && Auth::user()->tipo == TipoFuncionario::$Gerente){ // impedir que o gerente se delete
            $veiculo->delete();
            return redirect(route('listarVeiculos'))->with('success', 'Gerente removido com sucesso!');
        }

        return redirect(route('listarVeiculos'))->with('error', 'Houve um erro ao deletar este veículo');
    }
}
