<?php

namespace App\Http\Controllers;

use App\Models\Correlative;
use App\Models\Country;
use App\Models\State;
use App\Models\Ubigee;
class DataController extends Controller
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
   
    public function ListCountry()
    {
        $obj = Country::all();
        return $obj;
    }

    public function ListStates($country_code)
    {
        $obj = State::where('country_code',$country_code)->get();
        return $obj;
    }

    public function ListUbigee()
    {
        $obj = Ubigee::all();
        return $obj;
    }

    public function GetCorrelative($name)
    {
        $obj = Correlative::GetByModule($name);
        return response()->json(['status' => 200,'result' => $obj]);
    }




    
}
?>
