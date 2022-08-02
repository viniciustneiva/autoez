<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function listarFuncionarios() {
        $funcionarios = User::listarFuncionarios();

        return view('admin.funcionario.listar', ['funcionarios' => $funcionarios]);
    }

    public function editarFuncionario($id = null) {
        if($id) {
            $funcionario = User::getFuncionarioId($id);
            return view('admin.funcionario.editar',
                ['funcionario' => $funcionario]);
        }else{
            return view('admin.funcionario.editar');
        }
    }
}
