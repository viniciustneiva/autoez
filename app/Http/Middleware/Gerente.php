<?php

namespace App\Http\Middleware;

use App\Models\TipoFuncionario;
use Closure;
use Illuminate\Http\Request;

class Gerente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(TipoFuncionario::ehGerente()){
            return $next($request);
        }

        return redirect('/login');
    }
}
