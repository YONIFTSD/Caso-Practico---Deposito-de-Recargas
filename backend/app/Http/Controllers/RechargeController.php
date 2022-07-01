<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Correlative;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RechargeController extends Controller
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
            $obj = Recharge::ListAll($search);
            if($obj){
                return response()->json(['status' => 200,'result' => $obj]);
            }
            return response()->json(['status' => 404, 'message'=> 'A ocurrido un error']);
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
        
    }


    public function View($id_recharge)
    {
        try {
            $obj = Recharge::GetById($id_recharge);
            return response()->json(['status' => 200,'result' => $obj]);
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
    }

    public function Store(Request $request)
    {

   
        $this->validate($request, [
            'id_client' => 'required',
            'id_user' => 'required',
            'code' => 'required',
            'date' => 'required',
            'communication_channel' => 'required',
            'payment_method' => 'required',
            'coin' => 'required',
            'amount' => 'required',
            'state' => 'required',
        ]);
    
        try
        {   

        
            $correlative = Correlative::GetByModule('Recharge');
            $client = Client::find($request->id_client);
          
            $obj = new Recharge();
            $obj->id_client = $request->id_client;
            $obj->id_user = $request->id_user;
            $obj->code = $correlative->number;
            $obj->date = date('Y-m-d');
            $obj->communication_channel = $request->communication_channel;
            $obj->payment_method = $request->payment_method;
            $obj->payment_reference = $request->payment_reference;
            $obj->bank = $request->bank;
            $obj->file = '';
            $obj->observation = $request->observation;
            $obj->coin = $request->coin;
            $obj->amount = $request->amount;
            $obj->state = $request->state;
            $obj->reason_cancellation = '';
            $obj->save();

            $client->balance = $client->balance + $request->amount;
            $client->update();

            if ($request->hasFile('file')){
                $obj->file = $this->Upload($request->file('file'),$obj->code,'uploads/recharge/');
                $obj->update();
            }

            Correlative::Increase($correlative->id_correlative);

            return response()->json(['status' => 201,'message' => 'Se ha registrado correctamente la recarga','result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
    
    }

    public function Update(Request $request)
    {

   
        $this->validate($request, [
            'id_recharge' => 'required',
            'id_client' => 'required',
            'id_user' => 'required',
            'code' => 'required',
            'date' => 'required',
            'communication_channel' => 'required',
            'payment_method' => 'required',
            'coin' => 'required',
            'amount' => 'required',
            'state' => 'required',
        ]);
    
        try
        {   

            $recharge = Recharge::find($request->id_recharge,['state','amount']);
            $client = Client::find($request->id_client);

            if ($recharge->state != 1) {
                return response()->json(['status' => 404,'message' => 'La recarga ya fue anulada']);
            }
            
            $client->balance = $client->balance - $recharge->amount;
            $client->update();
          
            $obj = Recharge::find($request->id_recharge);
            $obj->id_user = $request->id_user;
            $obj->communication_channel = $request->communication_channel;
            $obj->payment_method = $request->payment_method;
            $obj->payment_reference = $request->payment_reference;
            $obj->bank = $request->bank;
            $obj->observation = $request->observation;
            $obj->coin = $request->coin;
            $obj->amount = $request->amount;
            $obj->update();

            $client->balance = $client->balance + $request->amount;
            $client->update();

            if ($request->hasFile('file')){
                $obj->file = $this->Upload($request->file('file'),$obj->code,'uploads/recharge/');
                $obj->update();
            }

            return response()->json(['status' => 200,'message' => 'Se ha modificado correctamente la recarga','result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
    
    }


    public function Cancel(Request $request)
    {

        
        $this->validate($request, [
            'id_recharge' => 'required',
            'id_user' => 'required',
            'reason' => 'required',
        ]);
    
        try
        {   

           
            $obj = Recharge::find($request->id_recharge);
           
            $client = Client::find($obj->id_client);
            
            if ($obj->state != 1) {
                return response()->json(['status' => 404,'message' => 'La recarga ya fue anulada']);
            }
            
            $client->balance = $client->balance - $obj->amount;
            $client->update();
       

            $obj->id_user = $request->id_user;
            $obj->reason_cancellation = $request->reason;
            $obj->state = 0;
            $obj->update();

            return response()->json(['status' => 200,'message' => 'Se ha anulado correctamente la recarga','result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
    
    }

    public function HistoryByClient($id_client)
    {
        try
        {   
            $obj = Recharge::HistoryByClient($id_client);
            return response()->json(['status' => 200,'result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
    }
    

    public function Upload($file,$name,$path)
    {
        $extension = $file->getClientOriginalExtension();
        $filenamestore = str_slug($name)."-".time().".".$extension;
        $file->move($path, $filenamestore);
        return $path.$filenamestore;
    }
}
?>
