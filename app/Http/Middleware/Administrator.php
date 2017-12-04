<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$guard = null)
    {
        $user = $request->user();
        if(!$user){
            return response()->redirectTo('/login');
        }elseif($user->is('admin') || $user->is('main-admin') ){
            return $next($request);
        }else{
            app()->abort(403);
        }
        
    }
}
