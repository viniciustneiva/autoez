<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TipoFuncionario extends Model
{
    use HasFactory;

    protected $table = 'tipo_funcionario';

    public static $Gerente = 1;

    public static $Funcionario = 2;

    public static function ehGerente() {
        return Auth::check() && Auth::user()->tipo == self::$Gerente;
    }

    public static function ehFuncionario() {
        return Auth::check() && Auth::user()->tipo == self::$Funcionario;
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
