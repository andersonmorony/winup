<?php

namespace winUp\Http\Middleware;

use Closure;
use winUp\user;
use Auth;

class checkRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
       if (!Auth::check()){
           return redirect('login');
        }

        $id = Auth::user()->id;
        $usuario = User::where('id', '=', $id)->first();
        
        //dd($usuario);

        if($usuario->role != $role){
            if($usuario->role == 1)
            {
                return redirect('/home');
            }
            elseif($usuario->role == 2)
            {
                return redirect('admin/home');
            }
            elseif($usuario->role == 3)
            {
                return redirect('cliente/home?negado=1');
            }
        }
        //dd($role);
        return $next($request);
    }
}
