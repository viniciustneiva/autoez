<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditMarcaRequest;
use App\Http\Requests\StoreMarcaRequest;
use App\Models\Marca;
use App\Models\TipoFuncionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarcaController extends Controller
{
    public function __construct() {
        $this->middleware('gerente');
    }

    public function listarMarcas() {
        $marcas = Marca::listarMarcas();
        return view('admin.marca.listar', ['marcas' => $marcas]);
    }

    public function editarMarca($id = null) {
        $marca = $id != null ? Marca::getMarcaId($id) : null;
        $edicao = ($id != null);
        return view('admin.marca.editar', ['marca' => $marca, 'edicao' => $edicao]);
    }

    public function saveCreateMarca(StoreMarcaRequest $request) {
        Marca::create([
            'name' => $request->name,
            'taxa' => $request->taxa,
        ]);
        return redirect()->route('listarMarcas')->with('success', 'Operação realizada com sucesso!');
    }

    public function saveEditMarca(EditMarcaRequest $request) {
        Marca::where('id', $request->id)->update($request->except('_token'));
        return redirect()->route('listarMarcas')->with('success', 'Operação realizada com sucesso!');
    }

    public function buscarMarca(Request $request) {
        if($request->validate(['name' => 'required'])){
            return response()->json(Marca::where('name', $request->name)->first());
        }
        return null;
    }

    public function buscarMarcaLike(Request $request) {
        if($request->validate(['name' => 'required'])){
            return response()->json(Marca::where('name', 'like', '%'.$request->name.'%')->get());
        }
        return null;
    }

    public function deletarMarca($id) {
        return Marca::deletarMarca($id);
    }
}
