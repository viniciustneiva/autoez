<?php

namespace App\Http\Controllers;

use App\Models\TipoFuncionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller {

    public function redirecionarUsuario() {
        if (TipoFuncionario::ehGerente() || TipoFuncionario::ehFuncionario()) {
            return redirect()->intended('/home');
        } else {
            if(Auth::check()) {
                Auth::logout();
            }
            return redirect('/login');
        }
    }

    public function fazerLogin() {
        if (!Auth::check()) {
            return view('auth.login');
        }
        return $this->redirecionarUsuario();
    }

}
