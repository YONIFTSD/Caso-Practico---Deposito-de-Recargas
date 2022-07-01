<?php

namespace App\Http\Controllers;


use App\Models\Report;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
class ReportController extends Controller
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
   
    public function Recharge(Request $request)
    {
        try{
            set_time_limit(0);
            $report = Report::Recharge($request->id_client,$request->id_user,$request->from,$request->to,$request->communication_channel,$request->payment_method,
            $request->bank,$request->coin);
            return response()->json(['status' => 200,'result' => $report]);
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
    }

    public function RechargeCancel(Request $request)
    {
        try{
            set_time_limit(0);
            $report = Report::RechargeCancel($request->id_client,$request->id_user,$request->from,$request->to,$request->communication_channel,$request->payment_method,
            $request->bank,$request->coin);
            return response()->json(['status' => 200,'result' => $report]);
        } catch (\Exception $e){   
            return response()->json(['status' => 400,'message' => 'A ocurrido un error', 'result' => $e->getMessage()]);
        } 
    }

    public function RechargeExcel($id_client,$id_user,$from,$to,$communication_channel,$payment_method,$bank,$coin)
    {
        
       
        set_time_limit(0);
        $dataexcel = Report::RechargeExcel($id_client,$id_user,$from,$to,$communication_channel,$payment_method,$bank,$coin);
  
        return Excel::create('R. Recargas '.date('Y-m-d'), function($excel)  use($dataexcel) {
            // Set the title
            $excel->setTitle('Recargas');
            $excel->setCreator('no no creator')->setCompany('Sistema');
            $excel->setDescription('Recargas');
    
            $excel->sheet('Recargas', function($sheet) use($dataexcel){
                
                $sheet->fromArray($dataexcel['data'], null, 'A1', false, false);
                $sheet->setAutoSize(true);
                //encabezado
                $sheet->mergeCells('A1:B1'); 
                $sheet->getStyle('A1:B1')->getAlignment()->applyFromArray(
                    array('horizontal' => 'right') //left,right,center & vertical
                );
                $sheet->cells('A1:B1', function($cells) {
                    $cells->setFontWeight('bold');
                }); 

                $sheet->mergeCells('C1:H1'); 
                $sheet->getStyle('C1:H1')->getAlignment()->applyFromArray(
                    array('horizontal' => 'left') //left,right,center & vertical
                );
                $sheet->cells('C1:H1', function($cells) {
                    $cells->setFontWeight('bold');
                }); 

                $sheet->mergeCells('A2:B2'); 
                $sheet->getStyle('A2:B2')->getAlignment()->applyFromArray(
                    array('horizontal' => 'right') //left,right,center & vertical
                );
                $sheet->cells('A2:B2', function($cells) {
                    $cells->setFontWeight('bold');
                }); 

                $sheet->mergeCells('C2:H2'); 
                $sheet->getStyle('C2:H2')->getAlignment()->applyFromArray(
                    array('horizontal' => 'left') //left,right,center & vertical
                );
                $sheet->cells('C2:H2', function($cells) {
                    $cells->setFontWeight('bold');
                }); 



                $sheet->mergeCells('A3:B3'); 
                $sheet->getStyle('A3:B3')->getAlignment()->applyFromArray(
                    array('horizontal' => 'right') //left,right,center & vertical
                );
                $sheet->cells('A3:B3', function($cells) {
                    $cells->setFontWeight('bold');
                }); 

                $sheet->mergeCells('C3:H3'); 
                $sheet->getStyle('C3:H3')->getAlignment()->applyFromArray(
                    array('horizontal' => 'left') //left,right,center & vertical
                );
                $sheet->cells('C3:G3', function($cells) {
                    $cells->setFontWeight('bold');
                }); 


                $sheet->mergeCells('A5:L5'); 
                $sheet->getStyle('A5:L5')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center') //left,right,center & vertical
                );
                $sheet->cells('A5:L5', function($cells) {
                    $cells->setBackground('#AAAAFF');
                    $cells->setFontWeight('bold');
                }); 
                
                for ($l=0; $l < count($dataexcel['header']); $l++) { 
                    if ($dataexcel['header'][$l]['concept'] == 'alignment') {
                        $sheet->getStyle($dataexcel['header'][$l]['cell'])->getAlignment()->applyFromArray(
                            array('horizontal' => $dataexcel['header'][$l]['value'])
                        );
                    }
                    if ($dataexcel['header'][$l]['concept'] == 'mergeCells') {
                        $sheet->mergeCells($dataexcel['header'][$l]['cell']);  
                        $sheet->getStyle($dataexcel['header'][$l]['cell'])->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                        );
                    }
                    if ($dataexcel['header'][$l]['concept'] == 'bold') {
                        $color = $dataexcel['header'][$l]['background'];
                        $sheet->cells($dataexcel['header'][$l]['cell'], function($cells) use ($color){
                            $cells->setBackground($color);
                            $cells->setFontWeight('bold');
                        }); 
                        $sheet->getStyle($dataexcel['header'][$l]['cell'])->getAlignment()->applyFromArray(
                            array('horizontal' => $dataexcel['header'][$l]['alignment'])
                        );
                    }
                }
                
                    
            });
        })->download('xlsx');
        exit();

    }

    public function RechargeExcelCancel($id_client,$id_user,$from,$to,$communication_channel,$payment_method,$bank,$coin)
    {
        
       
        set_time_limit(0);
        $dataexcel = Report::RechargeExcelCancel($id_client,$id_user,$from,$to,$communication_channel,$payment_method,$bank,$coin);
  
        return Excel::create('R. Recargas Anuladas '.date('Y-m-d'), function($excel)  use($dataexcel) {
            // Set the title
            $excel->setTitle('Recargas Anuladas');
            $excel->setCreator('no no creator')->setCompany('Sistema');
            $excel->setDescription('Recargas Anuladas');
    
            $excel->sheet('Recargas Anuladas', function($sheet) use($dataexcel){
                
                $sheet->fromArray($dataexcel['data'], null, 'A1', false, false);
                $sheet->setAutoSize(true);
                //encabezado
                $sheet->mergeCells('A1:B1'); 
                $sheet->getStyle('A1:B1')->getAlignment()->applyFromArray(
                    array('horizontal' => 'right') //left,right,center & vertical
                );
                $sheet->cells('A1:B1', function($cells) {
                    $cells->setFontWeight('bold');
                }); 

                $sheet->mergeCells('C1:H1'); 
                $sheet->getStyle('C1:H1')->getAlignment()->applyFromArray(
                    array('horizontal' => 'left') //left,right,center & vertical
                );
                $sheet->cells('C1:H1', function($cells) {
                    $cells->setFontWeight('bold');
                }); 

                $sheet->mergeCells('A2:B2'); 
                $sheet->getStyle('A2:B2')->getAlignment()->applyFromArray(
                    array('horizontal' => 'right') //left,right,center & vertical
                );
                $sheet->cells('A2:B2', function($cells) {
                    $cells->setFontWeight('bold');
                }); 

                $sheet->mergeCells('C2:H2'); 
                $sheet->getStyle('C2:H2')->getAlignment()->applyFromArray(
                    array('horizontal' => 'left') //left,right,center & vertical
                );
                $sheet->cells('C2:H2', function($cells) {
                    $cells->setFontWeight('bold');
                }); 



                $sheet->mergeCells('A3:B3'); 
                $sheet->getStyle('A3:B3')->getAlignment()->applyFromArray(
                    array('horizontal' => 'right') //left,right,center & vertical
                );
                $sheet->cells('A3:B3', function($cells) {
                    $cells->setFontWeight('bold');
                }); 

                $sheet->mergeCells('C3:H3'); 
                $sheet->getStyle('C3:H3')->getAlignment()->applyFromArray(
                    array('horizontal' => 'left') //left,right,center & vertical
                );
                $sheet->cells('C3:G3', function($cells) {
                    $cells->setFontWeight('bold');
                }); 


                $sheet->mergeCells('A5:L5'); 
                $sheet->getStyle('A5:L5')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center') //left,right,center & vertical
                );
                $sheet->cells('A5:L5', function($cells) {
                    $cells->setBackground('#AAAAFF');
                    $cells->setFontWeight('bold');
                }); 
                
                for ($l=0; $l < count($dataexcel['header']); $l++) { 
                    if ($dataexcel['header'][$l]['concept'] == 'alignment') {
                        $sheet->getStyle($dataexcel['header'][$l]['cell'])->getAlignment()->applyFromArray(
                            array('horizontal' => $dataexcel['header'][$l]['value'])
                        );
                    }
                    if ($dataexcel['header'][$l]['concept'] == 'mergeCells') {
                        $sheet->mergeCells($dataexcel['header'][$l]['cell']);  
                        $sheet->getStyle($dataexcel['header'][$l]['cell'])->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                        );
                    }
                    if ($dataexcel['header'][$l]['concept'] == 'bold') {
                        $color = $dataexcel['header'][$l]['background'];
                        $sheet->cells($dataexcel['header'][$l]['cell'], function($cells) use ($color){
                            $cells->setBackground($color);
                            $cells->setFontWeight('bold');
                        }); 
                        $sheet->getStyle($dataexcel['header'][$l]['cell'])->getAlignment()->applyFromArray(
                            array('horizontal' => $dataexcel['header'][$l]['alignment'])
                        );
                    }
                }
                
                    
            });
        })->download('xlsx');
        exit();

    }

}
?>
