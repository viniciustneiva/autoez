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

    public static function getClienteId($id) {
        return self::where('id', $id)
            ->first();
    }
}
