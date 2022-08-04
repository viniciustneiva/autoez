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

    public static function post($p_Data) {
        try {
            $p_Data['tipo'] = TipoFuncionario::$Gerente;
            DB::transaction(function () use ($p_Data) {
                self::updateOrCreate(['id' => $p_Data['id'] ?? null], $p_Data);

            });
            return true;
        } catch (\Exception $v_Exception) {
            return false;
        }
    }
}
