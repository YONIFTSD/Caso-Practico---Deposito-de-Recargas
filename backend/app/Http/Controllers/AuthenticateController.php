<?php

namespace App\Http\Controllers;

use App\Models\PrivilegeZone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{

    public function Login(Request $request)
    {
        if ($request->isJson()) {

            try {
                $user = User::where('email', $request->email)->where('state', 1)->first();
                if ($user && Hash::check($request->password, $user->password)) {
                    return response()->json(['status' => 200, 'result' => ['user' => $user]]);
                } else {
                    return response()->json(['status' => 404, 'result' => 'datos incorrectos']);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => 404, 'result' => 'error']);
            }
        }

        return response()->json(['status' => 405, 'error' => 'unauthtorized']);
    }
}
