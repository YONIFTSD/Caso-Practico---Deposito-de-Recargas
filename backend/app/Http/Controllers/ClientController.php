<?php

namespace App\Http\Controllers;
use App\Models\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ClientController extends Controller
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
   
    public function ListAll($search)
    {
        try{
            $obj = Client::ListAll($search);
            if($obj){
                return response()->json(['status' => 200,'result' => $obj]);
            }
            return response()->json(['status' => 404, 'message'=> 'A ocurrido un error']);
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
        
    }

    public function Search($search)
    {   
        $obj = Client::Search($search);
        $clients = array();
        foreach ($obj as $be) {
            array_push($clients,
                array(
                    'id' => $be->id_client,
                    'full_name' => $be->id_client." | ".$be->name.' - '.$be->document_number,
                )
            );
        }
       return $clients;
    }

    public function View($id_client)
    {
        try {
            $obj = Client::find($id_client);
            return response()->json(['status' => 200,'result' => $obj]);
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
    }

    public function Update(Request $request)
    {

      if($request->isJson()){
        $this->validate($request, [
            'id_client' => 'required',
            'document_type' => 'required',
            'document_number' => 'required',
            'name' => 'required',
            'state' => 'required',
        ]);
    
        try
        {   

        

            $client = Client::find($request->id_client);
            if ($client->document_type != $request->document_type || $client->document_number != $request->document_number ) {
                $validation = Client::where('document_type',$request->document_type)->where('document_number',$request->document_number)->where('state','<>',9)->count();
                if ($validation > 0) {
                    return response()->json(['status' => 400 ,'message' => 'El nro de documento del cliente ya fue previamente registrado']);
                }
            }
         

            $obj = Client::find($request->id_client);
            $obj->document_type = $request->document_type;
            $obj->document_number = $request->document_number;
            $obj->name = strtoupper($request->name);
            $obj->country = $request->country;
            $obj->address = $request->address;
            $obj->phone = $request->phone;
            $obj->email = $request->email;
            $obj->city = $request->city;
            $obj->sex = $request->sex;
            $obj->date_of_birth = $request->date_of_birth;
            $obj->state = $request->state;
            $obj->update();
            return response()->json(['status' => 200,'message' => 'Se ha modificado correctamente el cliente','result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
      } 
      return response()->json(['status' => 400,'message' => 'El recurso de destino no admite el formato de datos solicitado']);


    }
}
?>
