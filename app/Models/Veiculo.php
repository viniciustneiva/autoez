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



}
