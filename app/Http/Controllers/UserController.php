<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RafaelLaurindo\BrasilApi\BrasilApi;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function listarFuncionarios() {
        $funcionarios = User::listarFuncionarios();
        return view('admin.users.funcionario.listar', ['funcionarios' => $funcionarios]);
    }

    public function editarFuncionario($id = null) {
        if($id) {
            $funcionario = User::getFuncionarioId($id);
            return view('admin.users.funcionario.editar',
                ['funcionario' => $funcionario]);
        }else{
            return view('admin.users.funcionario.editar');
        }
    }

    public function buscarFuncionario(Request $request) {
        if($request->validate(['name' => 'required'])){
            return response()->json(User::with('tipos')->where('name', $request->name)->first());
        }
    }

    public function buscarFuncionarioLike(Request $request) {
        if($request->validate(['name' => 'required'])){
            return response()->json(User::with('tipos')->where('name', 'like', '%'.$request->name.'%')->get());
        }
    }


}
