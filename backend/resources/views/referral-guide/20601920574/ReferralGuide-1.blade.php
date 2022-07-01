@php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\DataManager;
$document_type = '';
switch ($referral_guide->document_type) {
    case '1': $document_type = 'DNI'; break;
    case '6': $document_type = 'RUC'; break;
    case '4': $document_type = 'CARNET DE EXTRANJERIA'; break;
    case '7': $document_type = 'PASAPORTE'; break;
    case '0': $document_type = 'OTROS'; break;
    default: $document_type = ''; break;

}
$name_qr = $business->document_number.'|'.$referral_guide->type_invoice.'|'.$referral_guide->serie.'|'.$referral_guide->number.'|'.$referral_guide->broadcast_date.'|'.$referral_guide->document_type.'|'.$referral_guide->document_number.'|'.$referral_guide->code_hash;
$path = str_replace("facturador", "api", $business->invoice_url);

$linkages = json_decode($referral_guide->linkages,true);
$voucher = '';
for ($i=0; $i < count($linkages) ; $i++) { 
    if($linkages[$i]['module'] == "Sale"){
        $voucher = $linkages[$i]['reference']; 
    }
    
}
@endphp
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        body{
            font-size: 12px;
            font-family: Courier New, Courier, monospace;
            padding: 0;
        }
        .table{
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        table thead tr th {
            text-align: center;
        }
        h3{
            text-align: center;
        }
        .text-center{ text-align: center; }
        .text-left{ text-align: left; }
        .text-right{ text-align: right; }
        .table-voucher {width: 100%; }
        .table-client {width: 100%; padding: 0px; margin-top: 1px;}
        .table-transport {width: 100%; padding: 0px; margin-top: 17px;}
        .table-detail {width: 100%; padding: 5px; margin-top: 2px;}
        .table-total {width: 100%; padding: 5px; margin-top: 10px;}
        .table-payment {width: 100%; padding: 5px; margin-top: 10px;}
        .color-trans {color: rgba(0,0,0,0);}
    
    </style>
</head>
<body>
    <table  class="table" >
        <tr>
            <td width="25%" align="center" >
               
            </td>
            <td width="50%">
            
            </td>
            <td width="25%">
                <table class="table-voucher">
                    <thead>
                        <tr>
                            <th class="text-center"> </th>
                        </tr>
                        <tr>
                            <th class="text-center bg-name-voucher"><br> </th>
                        </tr>
                        <tr>
                            <th class="text-right">{{$referral_guide->number }}</th>
                        </tr>
                    </thead>
                    
                </table>
            </td>
        </tr>
    </table>
    {{-- datos de guia --}}
    <table  class="table-client">
        <tr>
            <td width="17%"></td>
            <td width="83%">{{ $referral_guide->address_departure}}</td>
        </tr>
    </table>

    <table  class="table-client">
        <tr>
            <td width="18%"></td>
            <td width="82%">{{ $referral_guide->address_destination}}</td>
        </tr>
    </table>

    <table  class="table-client">
        <tr>
            <td width="25%"></td>
            <td width="75%">{{ $referral_guide->transfer_date}}</td>
        </tr>
    </table>

    <table  class="table-client">
        <tr>
            <td width="20%"></td>
            <td width="55%">{{ $referral_guide->name}}</td>
            <td width="10%"></td>
            <td width="10%">{{ $referral_guide->document_number}}</td>
        </tr>
    </table>
    {{-- datos de transporte --}}
    <table  class="table-transport">
        <tr>
            <td width="50%">
                <table width="100%">
                    <tr>
                        <td width="40%"></td>
                        <td width="60%">{{ !empty($referral_guide->brand) ? $referral_guide->brand:'-'  }}</td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td width="60%"></td>
                        <td width="40%">{{ !empty($referral_guide->plate) ? $referral_guide->plate:'-'  }}</td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td width="60%"></td>
                        <td width="40%">{{ !empty($referral_guide->drive_license_number) ? $referral_guide->drive_license_number:'-' }}</td>
                    </tr>
                </table>
            </td>
            <td width="50%">
                <table width="100%">
                    <tr>
                      
                        <td colspan="2" width="100%"><span class="color-trans">xxxxxxxxxxxxxxxxx</span>{{ !empty($referral_guide->carrier_name) ? $referral_guide->carrier_name:'-'  }}</td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td width="35%"></td>
                        <td width="65%">{{ !empty($referral_guide->carrier_document_number) ? $referral_guide->carrier_document_number : '-'  }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    {{-- detalle de guia de remision --}}
    <table  class="table-detail">
        <thead>
            <tr>
                <th width="10%"><br></th>
                <th width="57%"></th>
                <th width="10%"></th>
                <th width="12%"></th>
                <th width="10%"></th>
            </tr>
        </thead>
        <tbody>
        @php
            $j = 1;
        @endphp
        @foreach ($referral_guide_detail as $be)

        <tr>
            <td class="text-center">{{ substr($be->code, 2) }}</td>
            <td class="text-left">{{ $be->name }} {{ !empty($be->presentation) ? '- '.$be->presentation :'' }}</td>
            <td class="text-center">{{ $be->quantity}}</td>
            <td class="text-center">{{ DataManager::NameUnitMeasure($be->unit_measure)}}</td>
            <td class="text-right">{{ $be->weight_total}}</td>
        </tr>
        @php
            $j++;
        @endphp
        @endforeach
        @php
            $total = 10 - $j;
        @endphp
        @for ($i = 0; $i <= $total; $i++)
        <tr>
            <td class="text-center"><br></td>
            <td class="text-left"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-right"></td>
        </tr>
        @endfor
        </tbody>
    </table>

    <table  class="table-voucher">
        <tr>
            <td width="40%"></td>
            <td width="60%">{{ $voucher }}</td>
        </tr>
    </table>


</body>
</html>