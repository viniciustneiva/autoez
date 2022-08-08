<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Marca extends Model {
    use HasFactory;

    protected $table = "marca";

    protected $fillable = [
      'name', 'taxa'
    ];

    public static function getMarcas() {
        $v_List = self::orderBy('name')->get();
        return $v_List->pluck('name', 'id')->toArray();
    }

    public static function listarMarcas() {
        return self::orderBy('name')->get();
    }

    public static function getMarcaId($id) {
        return self::where('id', $id)
            ->first();
    }

    public static function deletarMarca($id) {
        $marca = Marca::find($id);

        if($marca && Auth::user()->tipo == TipoFuncionario::$Gerente){ // impedir que o gerente se delete
            try {
                $marca->delete();
                return redirect(route('listarMarcas'))->with('success', 'Marca removida com sucesso!');
            }catch (\Exception $e){
                return redirect()->back()->with('error', 'Houve um erro ao deletar esta marca');
            }
        }
    }


}
