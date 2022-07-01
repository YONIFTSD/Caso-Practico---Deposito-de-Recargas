<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DataManager extends Model
{

    public static function NameDocumentType($code){
        $name = '';
        switch ($code) {
            case '1': $name = 'DNI'; break;
            case '6': $name = 'RUC'; break;
            case '4': $name = 'CARNET DE EXTRANJERIA'; break;
            case '7': $name = 'PASAPORTE'; break;
            case '0': $name = 'OTROS'; break;
        
        }
        return $name;
    }

    public static function NameCommunicationChanel($code){
        $name = '';
        switch ($code) {
            case '01': $name = "Whatssap"; break;
            case '02': $name = "Telegram"; break;
        }
        return $name;
    }

    public static function NamePaymentMethod($code){
        $name = '';
        switch ($code) {
            case '01': $name = 'Pago Efectivo'; break;
            case '02': $name = 'Niubiz'; break;
            case '03': $name = 'AStroPay'; break;
            case '04': $name = 'Transfencia Bancaria'; break;
            case '05': $name = 'Yape'; break;
            case '06': $name = 'Plin'; break;
        }
        return $name;
    }

    public static function NameBank($code){
        $name = '';
        switch ($code) {
            case '001': $name = 'BANCO CENTRAL DE RESERVA DEL PERU'; break;
            case '002': $name = 'BANCO DE CREDITO DEL PERU'; break;
            case '003': $name = 'BANCO INTERNACIONAL DEL PERU'; break;
            case '005': $name = 'BANCO LATINO'; break;
            case '007': $name = 'BANCO CITIBANK N.A.'; break;
            case '008': $name = 'BANCO STANDARD CHARTERED'; break;
            case '009': $name = 'BCO.SCOTIABANK PERU SAA (ANTES WIESE SUDAMERIS)'; break;
            case '011': $name = 'BANCO CONTINENTAL'; break;
            case '018': $name = 'BANCO DE LA NACION'; break;
            case '023': $name = 'BANCO COMERCIO'; break;
            case '026': $name = 'BANCO NORBANK'; break;
            case '037': $name = 'BANCO DEL PROGRESO'; break;
            case '038': $name = 'BANCO INTERAMERICANO DE FINANZAS'; break;
            case '041': $name = 'BANCO SUDAMERICANO'; break;
            case '043': $name = 'BANCO DEL TRABAJO'; break;
            case '044': $name = 'BANCO SOLVENTA'; break;
            case '045': $name = 'BANCO SERBANCO'; break;
            case '046': $name = 'BANK BOSTON N.A. SUCURSAL DEL PERU'; break;
            case '047': $name = 'ORION CORPORACION DE CREDITO'; break;
            case '048': $name = 'BANCO NUEVO PAIS'; break;
            case '049': $name = 'MIBANCO'; break;
            case '050': $name = 'BANQUE NATIONALE DE PARIS - ANDES S.A.'; break;
            case '053': $name = 'BANCO HSBC'; break;
            case '056': $name = 'BANCO SANTANDER PERU S.A.'; break;
            case '071': $name = 'CORPORACION FINANCIERA DE DESARROLLO - COFIDE'; break;
            case '083': $name = 'SOLUCION - FINANCIERA DE CREDITO DEL PERU'; break;
            case '086': $name = 'FINANDAEWOO S.A.'; break;
            case '087': $name = 'FINANCIERA C.M.R.'; break;
            case '088': $name = 'VOLVO FINANCE PERU'; break;
            case '089': $name = 'FINANCIERA CORDILLERA S.A.'; break;
            case '091': $name = 'GENERALI PERU CIA. SEGUROS'; break;
            case '092': $name = 'LA VITALICIA'; break;
            case '093': $name = 'REASEGURADORA PERUANA'; break;
            case '094': $name = 'SEGUROS LA FENIX PERUANA'; break;
            case '095': $name = 'SECREX  CIA. SEGUROS'; break;
            case '099': $name = 'OTROS'; break;
        }
        return $name;
    }

    




}
