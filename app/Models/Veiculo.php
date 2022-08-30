<?php

namespace App\Models;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Veiculo extends Model
{

    use HasFactory;

    protected $table = "veiculo";

    protected $fillable = [
        'placa',
        'marca_id',
        'modelo',
        'cor',
        'ano',
        'valor',

        'disponivel',
    ];

    public function marca() {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public static function listarVeiculo() {
        return self::with('marca')->get();
    }

    public static function getVeiculoId($id) {
        return self::where('id', $id)
            ->where('disponivel', 1)
            ->first();
    }

    public static function getVeiculos(): array {
        return self::join('marca', 'marca.id', '=', 'veiculo.marca_id')
            ->selectRaw("veiculo.id, CONCAT(marca.name, ' - ', veiculo.modelo,' - ', veiculo.placa) as nomeVeiculo")
            ->orderBy('veiculo.placa')
            ->get()
            ->pluck('nomeVeiculo', 'id')
            ->toArray();
    }

    public static function getVeiculosDisponiveis() {
        return self::join('marca', 'marca.id', '=', 'veiculo.marca_id')
            ->selectRaw("veiculo.id, CONCAT(marca.name, ' - ', veiculo.modelo,' - ', veiculo.placa) as nomeVeiculo")
            ->orderBy('veiculo.placa')
            ->where('disponivel', 1)
            ->get()
            ->pluck('nomeVeiculo', 'id')
            ->toArray();
    }

    public static function emprestarVeiculo($id) {
        $veiculo = Veiculo::where('id', $id)->where('disponivel', 1)->first();
       if($veiculo) {
           $veiculo->disponivel = 0;
           $veiculo->save();
           return true;
       }

       return false;
    }

    public static function devolverVeiculo($id) {
        $veiculo = Veiculo::where('id', $id)->where('disponivel', 0)->first();
        if($veiculo) {
            $veiculo->disponivel = 1;
            $veiculo->save();
            return true;
        }
        return false;
    }


    public static function gerarRelatorioVeiculo() {
        return self::join('aluguel', 'aluguel.veiculo_id' ,'=', 'veiculo.id')
            ->join('marca', 'marca.id', '=', 'veiculo.marca_id')
            ->join('cliente', 'cliente.id', '=', 'aluguel.cliente_id')
            ->selectRaw('veiculo.*,marca.name as marca_name, marca.taxa, aluguel.entregue, cliente.name as cliente_nome')
            ->get();
    }



}
