<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Business extends Model
{

    protected $table = 'business';
    protected $primaryKey = 'id_company';


    public static function GetBusiness(){
        
        return DB::table('business')
        ->select('business.*')
        ->where('business.state', 1)
        ->first();

    }

}
