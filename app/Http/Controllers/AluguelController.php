<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditAluguelRequest;
use App\Http\Requests\StoreAluguelRequest;
use App\Models\Aluguel;
use App\Models\TipoFuncionario;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AluguelController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function listarAlugueis() {
        $alugueis = Aluguel::listarAlugueis();

        return view('admin.aluguel.listar', ['alugueis' => $alugueis]);
    }

    public function editarAluguel($id = null) {
        $aluguel = $id != null ? Aluguel::getAluguel($id) : null;
        $edicao = ($id != null);

        return view('admin.aluguel.editar', ['aluguel' => $aluguel, 'edicao' => $edicao]);
    }

    public function saveCreateAluguel(StoreAluguelRequest $request) {

        if(Veiculo::emprestarVeiculo($request->veiculo_id)){
            Aluguel::create([
                'cliente_id' => $request->cliente_id,
                'funcionario_id' => $request->funcionario_id,
                'veiculo_id' => $request->veiculo_id,
                'data_emprestimo' => $request->data_emprestimo,
                'prazo' => $request->prazo,
            ]);

            return redirect()->route('listarAlugueis')->with('success', 'Operação realizada com sucesso!');
        }

        return redirect()->back()->withInput()->with('error', 'Houve um erro ao alugar o veículo');

    }

    public function saveEditAluguel(EditAluguelRequest $request) {

        if($request->entregue == 1) {
          if(Veiculo::devolverVeiculo($request->veiculo_id)){
              Aluguel::where('id', $request->id)->update($request->except('_token'));
              return redirect()->route('listarAlugueis')->with('success', 'Veículo devolvido com sucesso!');
          }
        }else {
            if(Aluguel::where('id', $request->id)->update($request->except('_token'))){
                return redirect()->route('listarAlugueis')->with('success', 'Aluguel editado com sucesso!');
            }
        }

        return redirect()->back()->withInput()->with('error', 'A operação não pode ser realizada!');


    }

    public function deletarAluguel($id) {
        $aluguel = Aluguel::find($id)->first();

        if($aluguel && Auth::user()->tipo == TipoFuncionario::$Gerente){ // funcionario não pode deletar o aluguel
            if(Aluguel::deletarAluguel($aluguel->id)) {
                return redirect(route('listarAlugueis'))->with('success', 'Gerente removido com sucesso!');
            }

        }

        return redirect()->back()->withInput()->with('error', 'Houve um erro ao deletar esta marca');
    }

    public function buscarAluguel(Request $request) {
        if($request->validate(['name' => 'required'])){
            return response()->json(Aluguel::join('cliente', 'cliente.id' ,'=', 'aluguel.cliente_id')->where('cliente.name', $request->name)->first());
        }
        return null;
    }

    public function buscarAluguelLike(Request $request) {
        if($request->validate(['name' => 'required'])){
            return response()->json(Aluguel::join('veiculo', 'veiculo.id', '=', 'aluguel.veiculo_id')
                ->join('cliente', 'cliente.id', '=', 'aluguel.cliente_id')
                ->join('users', 'users.id', '=', 'aluguel.funcionario_id')
                ->join('marca', 'marca.id', '=', 'veiculo.marca_id')
                ->with('funcionario', 'cliente', 'veiculo')
                ->selectRaw('aluguel.*,
             ROUND(CONVERT(REPLACE(REPLACE(veiculo.valor, "R$", ""), ".", ""), DECIMAL),2) as valor_extenso,
              DATEDIFF(aluguel.data_entrega, aluguel.data_emprestimo) as dias_utilizados,
               marca.taxa as taxa_marca,
               CEIL(REPLACE(REPLACE(veiculo.valor, "R$", ""), "." , "")) * marca.taxa  as diaria')
                ->where('cliente.name', 'like', '%'.$request->name.'%')
                ->get());
        }
        return null;
    }

    public function gerarRelatorioAluguel() {
        $alugueis = Aluguel::gerarRelatorio();

        return view('admin.relatorio.listarAluguel', ['listaAlugueis' => $alugueis]);
    }

}
