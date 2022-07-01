<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Closure;
use App\Models\PrivilegeZone; 
use App\User;
class AuthenticateClient
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
        
        $User = Client::where('token', $request->header('token'))->first();
        if($User)
        {
            return $next($request);
        }else{
            return response()->json(['status' => 401, 'error' => 'Ingrese sus credenciales' ]);
        }

    }
}
