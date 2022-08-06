<?php

namespace App\Http\Controllers;

use App\Models\Gerente;
use App\Models\TipoFuncionario;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\EditFuncionarioRequest;
use App\Http\Requests\StoreFuncionarioRequest;

class GerenteController extends Controller {

    public function __construct() {
        $this->middleware('gerente');
    }

    public function listarGerentes() {
        $gerentes = Gerente::listarGerentes();
        return view('admin.users.gerente.listar', ['gerentes' => $gerentes]);
    }

    public function listarFuncionarios() {
        $funcionarios = User::listarFuncionarios();
        return view('admin.users.funcionario.listar', ['funcionarios' => $funcionarios]);
    }

    public function editarGerente($id = null) {
        $gerente = $id != null ? Gerente::getGerenteId($id) : null;
        $edicao = ($id != null);
        return view('admin.users.gerente.editar', ['gerente' => $gerente, 'edicao' => $edicao]);
    }

    public function editarFuncionario($id = null) {
        $funcionario = $id != null ? User::getFuncionarioId($id) : null;
        $edicao = ($id != null);
        return view('admin.users.funcionario.editar', ['funcionario' => $funcionario , 'edicao' => $edicao]);

    }

    public function saveCreateGerente(StoreFuncionarioRequest $request) {
        Gerente::create([
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
            'tipo' => 1,
            'data_nascimento' => $request->data_nascimento,
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('listarGerentes')->with('success', 'Operação realizada com sucesso!');
    }

    public function saveCreateFuncionario(StoreFuncionarioRequest $request) {
        User::create([
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
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('listarFuncionarios')->with('success', 'Operação realizada com sucesso!');
    }

    public function saveEditGerente(EditFuncionarioRequest $request) {
        if($request->get('password')){
            Gerente::where('id', $request->id)->update($request->except('_token', 'password_confirmation'));
        }else{
            Gerente::where('id', $request->id)->update($request->except('_token', 'password_confirmation', 'password'));
        }

        return redirect()->route('listarGerentes');
    }

    public function saveEditFuncionario(EditFuncionarioRequest $request) {

        if($request->get('password')){
            User::where('id', $request->id)->update($request->except('_token', 'password_confirmation'));
        }else{
            User::where('id', $request->id)->update($request->except('_token', 'password_confirmation', 'password'));
        }

        return redirect()->route('listarFuncionarios')->with('success', 'Operação realizada com sucesso!');
    }

    public function buscarFuncionario(Request $request) {
        if($request->validate(['name' => 'required'])){
            return response()->json(User::with('tipos')->where('name', $request->name)->first());
        }
        return null;
    }

    public function buscarFuncionarioLike(Request $request) {
        if($request->validate(['name' => 'required'])){
            return response()->json(User::with('tipos')->where('name', 'like', '%'.$request->name.'%')->get());
        }
        return null;
    }

}
