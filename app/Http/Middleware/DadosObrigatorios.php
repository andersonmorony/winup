<?php

namespace winUp\Http\Middleware;

use Closure;
use winUp\DadosUser;
use Auth;
class DadosObrigatorios
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

        $id = Auth::user()->id;

        //dd($id);
        $dados = DadosUser::where('user_id', $id)->first();

       

        if(!isset($dados->id))
        {
             //dd($dados);
             return redirect('/finalizando-cadastro');
        }

        return $next($request);
    }
}
