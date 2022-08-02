<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gerente extends User
{
    use HasFactory;

    protected $table = "users";


    public static function listarGerentes() {
        return self::select('name', 'email', 'id')
            ->where('tipo', TipoFuncionario::$Gerente)
            ->get();
    }
}
