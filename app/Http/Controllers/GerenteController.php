<?php

namespace App\Http\Controllers;

use App\Models\Gerente;
use App\Models\User;
use Illuminate\Http\Request;

class GerenteController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function listarGerentes() {
        $gerentes = Gerente::listarGerentes();
        return view('admin.users.gerente.listar', ['gerentes' => $gerentes]);
    }

    public function editarGerente($id = null) {
        $gerente = $id != null ? User::whereId($id)->get() : null;

        return view('admin.users.gerente.editar',
                ['gerente' => $gerente]);

    }

    public function salvarGerente(Request $request) {
        $validacao = isset($request->id) ? User::regrasValidacao($request->id) : User::regrasValidacao();
        $resultado_validacao = $request->validate(User::regrasValidacao($validacao));
        return Gerente::post($resultado_validacao) ? redirect('/gerentes')->with('message', "Operação realizada com sucesso!") :
            redirect()->back()->withInput()->with('error_message', "Operação falhou!");

    }
}
