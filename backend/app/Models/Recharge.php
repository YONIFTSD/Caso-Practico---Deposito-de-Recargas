<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recharge extends Model
{
    protected $table = 'recharge';
    protected $primaryKey = 'id_recharge';

    public static function ListAll($search){
        
        $search = urldecode($search);
        return DB::table('recharge')
        ->leftJoin('clients','clients.id_client','recharge.id_client')
        ->leftJoin('users','users.id_user','recharge.id_user')
        ->select('recharge.*','clients.document_type','clients.document_number','clients.name','users.user')
        ->where('recharge.state','<>', 9)
        ->where(function ($query) use ($search) {
            if(!empty($search) && $search != "all"){
                $query = $query->orWhere('clients.id_client','like',"%$search%");
                $query = $query->orWhere('clients.name','like',"%$search%");
                $query = $query->orWhere('clients.document_number','like',"%$search%");
                $query = $query->orWhere('clients.email','like',"%$search%");
                $query = $query->orWhere('recharge.id_recharge','like',"%$search%");
            }
        })
        ->orderBy('recharge.id_recharge','DESC')
        ->paginate(15);
      
    }

    public static function GetById($id_recharge){
        
        return DB::table('recharge')
        ->leftJoin('clients','clients.id_client','recharge.id_client')
        ->leftJoin('users','users.id_user','recharge.id_user')
        ->select('recharge.*','clients.document_type','clients.document_number','clients.name','users.user')
        ->where('recharge.id_recharge',$id_recharge)
        ->first();
        
    }

    public static function HistoryByClient($id_client){
        return DB::table('recharge')
        ->leftJoin('clients','clients.id_client','recharge.id_client')
        ->leftJoin('users','users.id_user','recharge.id_user')
        ->select('recharge.*','clients.document_type','clients.document_number','clients.name','users.user')
        ->where('recharge.state','<>', 0)
        ->where('recharge.id_client',$id_client)
        ->orderBy('recharge.id_recharge','DESC')
        ->get();
      
    }

}
