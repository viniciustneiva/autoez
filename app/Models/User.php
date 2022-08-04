<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use RafaelLaurindo\BrasilApi\BrasilApi;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function regrasValidacao($id = null) {
        $v_Rules = [
            'name' => 'required',
            'email' => 'required|email',
            'cpf' => 'required',
            'cep' => 'required',
            'rua' => 'required',
            'numero' => 'required|numeric',
            'complemento' => 'nullable',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required|max:2',
            'telefone' => 'required',
        ];
        if($id) {
            $v_Rules['id'] = 'required|exists:users,id';
        }

        return $v_Rules;
    }

    public function tipos() {
        return $this->belongsTo(TipoFuncionario::class, 'tipo');
    }


    public static function listarFuncionarios() {
        return self::where('tipo', TipoFuncionario::$Funcionario)
            ->get();
    }

    public static function getFuncionarioId($id) {
        return self::select('users.*')
            ->where('id', $id)
            ->first();
    }



}
