<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditClienteRequest;
use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listarClientes(){
        $clientes = Cliente::listarClientes();
        return view('admin.cliente.listar', ['clientes' => $clientes]);
    }

    public function buscarCliente(Request $request) {
        if($request->validate(['name' => 'required'])){
            return response()->json(Cliente::where('name', $request->name)->first());
        }
        return null;
    }

    public function editarCliente($id = null) {
        $cliente = $id != null ? Cliente::getClienteId($id) : null;
        $edicao = ($id != null);
        return view('admin.cliente.editar', ['cliente' => $cliente, 'edicao' => $edicao]);
    }

    public function buscarClienteLike(Request $request) {
        if($request->validate(['name' => 'required'])){
            return response()->json(Cliente::where('name', 'like', '%'.$request->name.'%')->get());
        }
        return null;
    }

    public function saveCreateCliente(StoreClienteRequest $request) {
        if(Cliente::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'cep' => $request->cep,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'complemento' => $request->complemento ?? null,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'telefone' => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
        ])) {
            return redirect()->route('listarClientes')->with('success', 'Operação realizada com sucesso!');
        }

        return redirect()->back()->withInput()->with('error', 'Não foi possível criar o cliente');
    }

    public function saveEditCliente(EditClienteRequest $request) {
        if(Cliente::where('id', $request->id)->update($request->except('_token'))) {
            return redirect()->route('listarClientes')->with('success', 'Operação realizada com sucesso!');
        }

        return redirect()->back()->withInput()->with('error', 'Não foi possível criar o cliente');

    }
}
