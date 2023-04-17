<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class Kapus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error_email','Harap login dulu!');
        }
        $user = Auth::user();
        if($user->role == 'kapus'){
            return $next($request);
        }
        return redirect('/login')->with('error_email','Anda tidak mempunyai hak akses');
    }
}
