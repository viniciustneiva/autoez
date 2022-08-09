<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Aluguel extends Model
{
    use HasFactory;

    protected $table = "aluguel";

    protected $fillable = [
        'cliente_id',
        'funcionario_id',
        'veiculo_id',
        'data_emprestimo',
        'prazo',
        'data_entrega',
        'entregue',
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function funcionario() {
        return $this->belongsTo(User::class, 'funcionario_id');
    }

    public function veiculo() {
        return $this->belongsTo(Veiculo::class, 'veiculo_id');
    }

    public static function listarAlugueis() {
        return self::join('veiculo', 'veiculo.id', '=', 'aluguel.veiculo_id')
            ->join('cliente', 'cliente.id', '=', 'aluguel.cliente_id')
            ->join('users', 'users.id', '=', 'aluguel.funcionario_id')
            ->join('marca', 'marca.id', '=', 'veiculo.marca_id')
            ->with('funcionario', 'cliente', 'veiculo')
            ->orderBy('aluguel.updated_at', 'desc')
            ->selectRaw('aluguel.*, marca.name as marca_carro,
             ROUND(CONVERT(REPLACE(REPLACE(veiculo.valor, "R$", ""), ".", ""), DECIMAL),2) as valor_extenso,
              DATEDIFF(aluguel.data_entrega, aluguel.data_emprestimo) as dias_utilizados,
               marca.taxa as taxa_marca,
               CEIL(REPLACE(REPLACE(veiculo.valor, "R$", ""), "." , "")) * marca.taxa  as diaria')
            ->get();
    }

    public static function getAluguel($id) {
        return self::where('id', $id)
            ->first();
    }

    public static function deletarAluguel($id) {
        $aluguel = self::where('id', $id)
            ->first();
        if($aluguel->data_entrega && $aluguel->entregue == 1) {
            $aluguel->delete();
            return true;
        }

        return false;
    }

    public static function gerarRelatorio() {
        $aluguel = self::join('veiculo', 'veiculo.id', '=', 'aluguel.veiculo_id')
            ->join('cliente', 'cliente.id', '=', 'aluguel.cliente_id')
            ->join('users', 'users.id', '=', 'aluguel.funcionario_id')
            ->join('marca', 'marca.id', '=', 'veiculo.marca_id')
            ->with('funcionario', 'cliente', 'veiculo')
            ->orderBy('created_at')
            ->selectRaw('aluguel.*, marca.name as marca_carro,
             ROUND(CONVERT(REPLACE(REPLACE(veiculo.valor, "R$", ""), ".", ""), DECIMAL),2) as valor_extenso,
              DATEDIFF(aluguel.data_entrega, aluguel.data_emprestimo) as dias_utilizados,
               marca.taxa as taxa_marca,
               CEIL(REPLACE(REPLACE(veiculo.valor, "R$", ""), "." , "")) * marca.taxa  as diaria')
            ->get();

        return $aluguel;
    }

}
