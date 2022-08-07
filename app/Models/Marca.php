<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model {
    use HasFactory;


    protected $table = "marca";

    public static function getMarcas() {
        $v_List = self::orderBy('name')->get();
        return $v_List->pluck('name', 'id')->toArray();
    }
}
