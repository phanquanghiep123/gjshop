<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * Description of ContributorFileUpload
 *
 * @author dinhtrong
 */
class ContributorFileUpload {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null) {
        $user = $request->user();
        if(!$user){
            app()->abort(401);
        }
        return $next($request);
    }

}
