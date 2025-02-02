<?php

// En app/Http/Middleware/RedirectIfAuthenticated.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->role) {
                case 'medico':
                    return redirect('/medico');
                case 'paciente':
                    return redirect('/paciente');
                case 'secretaria':
                    return redirect('/secretaria');
                case 'gerente':
                    return redirect('/gerente');
                default:
                    return redirect('/home');
            }
        }

        return $next($request);
    }
}
