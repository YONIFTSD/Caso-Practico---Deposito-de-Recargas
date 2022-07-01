<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PrivilegeZone; 
use App\User;
class CheckRole
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
        $User = User::where('api_token', $request->header('token'))->first();
        if($User)
        {
            return $next($request);
        }else{
            return response()->json(['status' => 401, 'error' => 'No cuenta con permisos para acceder a este modulo' ]);
        }

    }
}
