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
        return view('admin.gerente.listar', ['gerentes' => $gerentes]);
    }

    public function editarGerente($id = null) {
        if($id) {
            return view('admin.gerente.edit',
                ['gerente' => Gerente::findOrFail($id)->first() || null]);
        }else{
            return view('admin.gerente.editar');
        }
    }
}
