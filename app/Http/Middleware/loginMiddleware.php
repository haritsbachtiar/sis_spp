<?php

namespace App\Http\Middleware;

use Closure;

class loginMiddleware
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
        $token = \Session::get('token');

        if($token == 'admin_sis_spp'){
            return $next($request);
        }else{
            return redirect('');
        }
    }
}
