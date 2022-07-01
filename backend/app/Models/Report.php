<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Empty_;

class Report extends Model
{
 
    public static function Recharge($id_client,$id_user,$from,$to,$communication_channel,$payment_method,
    $bank,$coin){

        $result = DB::table('recharge')
        ->leftJoin('clients','clients.id_client','recharge.id_client')
        ->leftJoin('users','users.id_user','recharge.id_user')
        ->select('recharge.*','clients.document_type','clients.document_number','clients.name','users.user')
        ->where('recharge.state','<>', 0)
        ->whereBetween('recharge.date',[$from,$to])
        ->where(function ($query) use ($id_client,$id_user,$communication_channel,$payment_method, $bank,$coin) {
            if(!empty($id_client) && $id_client != "all"){
                $query = $query->where('recharge.id_client',$id_client);
            }
            if(!empty($id_user) && $id_user != "all"){
                $query = $query->where('recharge.id_user',$id_user);
            }
            if(!empty($communication_channel) && $communication_channel != "all"){
                $query = $query->where('recharge.communication_channel',$communication_channel);
            }
            if(!empty($payment_method) && $payment_method != "all"){
                $query = $query->where('recharge.payment_method',$payment_method);
            }
            if(!empty($bank) && $bank != "all"){
                $query = $query->where('recharge.bank',$bank);
            }
            if(!empty($coin) && $coin != "all"){
                $query = $query->where('recharge.coin',$coin);
            }
        })
        ->orderBy('recharge.id_recharge','DESC')
        ->get();

    
        return $result;
        
    }

    public static function RechargeCancel($id_client,$id_user,$from,$to,$communication_channel,$payment_method,
    $bank,$coin){

        $result = DB::table('recharge')
        ->leftJoin('clients','clients.id_client','recharge.id_client')
        ->leftJoin('users','users.id_user','recharge.id_user')
        ->select('recharge.*','clients.document_type','clients.document_number','clients.name','users.user')
        ->where('recharge.state',0)
        ->whereBetween('recharge.date',[$from,$to])
        ->where(function ($query) use ($id_client,$id_user,$communication_channel,$payment_method, $bank,$coin) {
            if(!empty($id_client) && $id_client != "all"){
                $query = $query->where('recharge.id_client',$id_client);
            }
            if(!empty($id_user) && $id_user != "all"){
                $query = $query->where('recharge.id_user',$id_user);
            }
            if(!empty($communication_channel) && $communication_channel != "all"){
                $query = $query->where('recharge.communication_channel',$communication_channel);
            }
            if(!empty($payment_method) && $payment_method != "all"){
                $query = $query->where('recharge.payment_method',$payment_method);
            }
            if(!empty($bank) && $bank != "all"){
                $query = $query->where('recharge.bank',$bank);
            }
            if(!empty($coin) && $coin != "all"){
                $query = $query->where('recharge.coin',$coin);
            }
        })
        ->orderBy('recharge.id_recharge','DESC')
        ->get();

    
        return $result;
        
    }



    public static function RechargeExcel($id_client,$id_user,$from,$to,$communication_channel,$payment_method,$bank,$coin){
    
        set_time_limit(0);
        $business = Business::GetBusiness();
        $report = Report::Recharge($id_client,$id_user,$from,$to,$communication_channel,$payment_method,$bank,$coin);
        $header = array();
        $data = array(
            array('Empresa :','', $business->name),
            array('RUC :','', $business->document_number),
            array('','',''),
            array('',''),
            array('REPORTE DE RECARGAS ('.$from.' - '.$to.')'),
        );
    

        array_push($data,array(''));
        array_push($data,array('#','ID ','Cliente','M. de Comunicación','M. de Pago','Referencia','Banco','Moneda','Total','F. Registro','Usuario','Estado'));
        array_push($header,array(
            'cell'=>'A7:L7',
            'concept' => 'alignment',
            'value' => 'center',
        ));
        array_push($header,array(
            'cell'=>'A7:L7',
            'concept' => 'bold',
            'alignment' => 'center',
            'background' => '#AAAAFF',
        ));
        $index = 1;
        foreach ($report as $be) {
            array_push($data,array(
                $index,
                $be->id_recharge,
                $be->name." - ".$be->document_number,
                DataManager::NameCommunicationChanel($be->communication_channel),
                DataManager::NamePaymentMethod($be->payment_method),
                $be->payment_reference,
                DataManager::NameBank($be->bank),
                $be->coin,
                floatval($be->amount),
                $be->created_at,
                $be->user,
                $be->state == 1 ? 'Activo':'Anulado',
            ));
            $index++;
        }
  

        return array('data'=>$data,'header'=>$header);
        
    }

    public static function RechargeExcelCancel($id_client,$id_user,$from,$to,$communication_channel,$payment_method,$bank,$coin){
    
        set_time_limit(0);
        $business = Business::GetBusiness();
        $report = Report::RechargeCancel($id_client,$id_user,$from,$to,$communication_channel,$payment_method,$bank,$coin);
        $header = array();
        $data = array(
            array('Empresa :','', $business->name),
            array('RUC :','', $business->document_number),
            array('','',''),
            array('',''),
            array('REPORTE DE RECARGAS ANULADAS ('.$from.' - '.$to.')'),
        );
    

        array_push($data,array(''));
        array_push($data,array('#','ID ','Cliente','M. de Comunicación','M. de Pago','Referencia','Banco','Moneda','Total','F. Registro','Usuario','Motivo'));
        array_push($header,array(
            'cell'=>'A7:L7',
            'concept' => 'alignment',
            'value' => 'center',
        ));
        array_push($header,array(
            'cell'=>'A7:L7',
            'concept' => 'bold',
            'alignment' => 'center',
            'background' => '#AAAAFF',
        ));
        $index = 1;
        foreach ($report as $be) {
            array_push($data,array(
                $index,
                $be->id_recharge,
                $be->name." - ".$be->document_number,
                DataManager::NameCommunicationChanel($be->communication_channel),
                DataManager::NamePaymentMethod($be->payment_method),
                $be->payment_reference,
                DataManager::NameBank($be->bank),
                $be->coin,
                floatval($be->amount),
                $be->created_at,
                $be->user,
                $be->reason_cancellation,
            ));
            $index++;
        }
  

        return array('data'=>$data,'header'=>$header);
        
    }

}
