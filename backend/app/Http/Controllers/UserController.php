<?php

namespace App\Http\Controllers;
use App\User;
// use App\Models\ZonaPrivilegio;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
   
    public function ListActive()
    {
        $obj = User::where('state',1)->get(['id_user','user']);
        return response()->json(['status' => 200,'result' => $obj]);
        
    }

    public function View($id_user)
    {
        $obj = User::find($id_user);
        if($obj){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }
    
}
?>
