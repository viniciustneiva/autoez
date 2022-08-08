<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "cliente";

    protected $fillable = [
        'email',
        'name',
        'cpf',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'telefone',
        'data_nascimento',
    ];

    public static function listarClientes() {
        return self::all();
    }

    public static function getClientes() {
        return self::orderBy('name')->get()->pluck('name', 'id')->toArray();
    }

    public static function getClienteId($id) {
        return self::where('id', $id)
            ->first();
    }

    public static function gerarRelatorio() {
        return self::join('aluguel', 'aluguel.cliente_id', '=', 'cliente.id')
            ->join('veiculo', 'veiculo.id', '=', 'aluguel.veiculo_id')
            ->join('marca', 'marca.id', '=', 'veiculo.marca_id')
            ->orderBy('cliente.updated_at')
            ->selectRaw('cliente.*, aluguel.*, veiculo.*, marca.name as marca_carro,
             ROUND(CONVERT(REPLACE(REPLACE(veiculo.valor, "R$", ""), ".", ""), DECIMAL),2) as valor_extenso,
              DATEDIFF(aluguel.data_entrega, aluguel.data_emprestimo) as dias_utilizados,
               marca.taxa as taxa_marca,
               CEIL(REPLACE(REPLACE(veiculo.valor, "R$", ""), "." , "")) * marca.taxa  as diaria')
            ->get();
    }
}
