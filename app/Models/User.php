<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
        'password',
        'tipo'
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

    protected $guarded = ['password', 'remember_token'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function tipos() {
        return $this->belongsTo(TipoFuncionario::class, 'tipo');
    }


    public static function listarFuncionarios() {
        return self::where('tipo', TipoFuncionario::$Funcionario)
            ->get();
    }

    public static function getFuncionarioId($id) {
        return self::where('id', $id)
            ->where('tipo', TipoFuncionario::$Funcionario)
            ->first();
    }

    public static function post($data) {
        try {

            DB::transaction(function () use ($data) {
                self::updateOrCreate(['id' => $data['id'] ?? null], $data);
            });
            return true;
        } catch (\Exception $v_Exception) {
            return false;
        }
    }



}
