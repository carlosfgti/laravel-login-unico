<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserUniqueAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* Verifica se o valor da coluna/sessão "token_access" NÃO é compátivel com o valor da sessão que criamos quando o usuário fez login
        */
        if (auth()->user()->token_access != session()->get('access_token')) {
            // Faz o logout do usuário
            \Auth::logout();

            // Redireciona o usuário para a página de login, com session flash "message"
            return redirect()
                        ->route('login')
                        ->with('message', 'A sessão deste usuário está ativa em outro local!');
        }

        // Permite o acesso, continua a requisição
        return $next($request);
    }
}
