<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gerente extends User
{
    use HasFactory;

    protected $table = "users";



    public static function listarGerentes() {
        return self::where('tipo', TipoFuncionario::$Gerente)
            ->get();
    }

    public static function getGerenteId($id) {
        return self::select('users.*')
            ->where('id', $id)
            ->where('tipo', TipoFuncionario::$Gerente)
            ->first();
    }

}
