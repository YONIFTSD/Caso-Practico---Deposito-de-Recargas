<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id_client';
    protected $hidden = [
        'password',
    ];

    public static function ListAll($search){
        
        $search = urldecode($search);
        return DB::table('clients')
        ->select('clients.*')
        ->where('clients.state','<>', 9)
        ->where(function ($query) use ($search) {
            if(!empty($search) && $search != "all"){
                $query = $query->orWhere('clients.name','like',"%$search%");
                $query = $query->orWhere('clients.document_number','like',"%$search%");
                $query = $query->orWhere('clients.email','like',"%$search%");
            }
        })
        ->orderBy('clients.id_client','DESC')
        ->paginate(15);
      
    }

    public static function Search($search){
        
        $search = urldecode($search);
        return DB::table('clients')
        ->select('clients.id_client','clients.document_number','clients.name')
        ->where('clients.state','<>', 9)
        ->where(function ($query) use ($search) {
            $query = $query->orWhere('clients.id_client','like',"%$search%");
            $query = $query->orWhere('clients.name','like',"%$search%");
            $query = $query->orWhere('clients.document_number','like',"%$search%");
        })
        ->orderBy('clients.id_client','DESC')
        ->limit(15)
        ->get();
        
    }


}
