<?php

namespace App\Http\Controllers;

use App\Http\Middleware\funcionario;
use App\Http\Requests\EditFuncionarioRequest;
use App\Http\Requests\StoreFuncionarioRequest;
use App\Models\TipoFuncionario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RafaelLaurindo\BrasilApi\BrasilApi;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

}
