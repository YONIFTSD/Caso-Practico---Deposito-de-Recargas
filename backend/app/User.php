<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    protected $primaryKey = 'id_user';


    protected $fillable = [
        'api_token', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    
    //Listar Registros
    public static function ListAll($search){
        $search = urldecode($search);
        return DB::table('users')
        ->select('users.*')
        ->where('users.state','<>', 9)
        ->where(function ($query) use ($search) {
            if(!empty($search) && $search != "all"){
                $query = $query->orWhere('users.email','like',"%$search%");
                $query = $query->orWhere('users.name','like',"%$search%");
                $query = $query->orWhere('users.last_name','like',"%$search%");
            }
            
        })
        ->orderBy('users.id_user','DESC')
        ->paginate(15);
    }


    
}
