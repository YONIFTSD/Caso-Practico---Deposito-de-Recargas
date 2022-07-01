@php
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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


@endphp
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        body{
            font-size: 10px;
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
        .bg-name-voucher{ background-color: #00174F; color: #fff;}
        .table-voucher {width: 100%; border: 1px solid black;}
        .table-client {width: 100%; border: 1px solid black; padding: 5px; margin-top: 10px;}
        .table-detail {width: 100%; border: 1px solid black; padding: 5px; margin-top: 10px;}
        .table-total {width: 100%; border: 1px solid black; padding: 5px; margin-top: 10px;}
        .table-payment {width: 100%; border: 1px solid black; padding: 5px; margin-top: 10px;}
        .table-detail thead tr th { background-color: #00174F; color: #fff; text-align: center; }
    </style>
</head>
<body>
    <table  class="table" >
        <tr>
            <td width="25%" align="center" >
                <img width="120px" src="{{ $path.$business->logo }}" >
            </td>
            <td width="50%">
                <table class="table">
                    <tr>
                        <th class="text-center" style="font-size: 15px">{{ $business->name }}</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="font-size: 13">{{ $business->document_number }}</th>
                    </tr>
                    <tr>
                        <th class="text-center">Direccion:{{ $business->address }}</th>
                    </tr>
                    <tr>
                        <th class="text-center">Telefono: {{ $business->phone }}4</th>
                    </tr>
                    <tr>
                        <th class="text-center">Email: {{ $business->email }}</th>
                    </tr>
                </table>
            </td>
            <td width="25%">
                <table class="table-voucher">
                    <thead>
                        <tr>
                            <th class="text-center">{{ $business->document_number }}</th>
                        </tr>
                        <tr>
                            <th class="text-center bg-name-voucher">GUIA DE REMISIÓN <br>REMITENTE</th>
                        </tr>
                        <tr>
                            <th class="text-center">{{$referral_guide->serie }}-{{$referral_guide->number }}</th>
                        </tr>
                    </thead>
                    
                </table>
            </td>
        </tr>
    </table>

    <table  class="table-client">
        <tr>
            <td width="50%"><strong>Destinatario :</strong>{{ strtoupper($referral_guide->name) }}</td>
            <td width="50%"><strong>Punto de Partida :</strong>{{ $referral_guide->address_departure }}</td>
        </tr>
        <tr>
            <td width="50%" ><strong>{{ $document_type}} :</strong>{{ $referral_guide->document_number}}</td>
            <td width="50%"><strong>Punto de Llegada :</strong>{{ $referral_guide->address_destination}}</td>
        </tr>
        <tr>
            <td width="50%" ><strong>Fecha Emisión :</strong>{{ $referral_guide->broadcast_date}}  - <strong> Fecha Translado :</strong>{{ $referral_guide->transfer_date}}</td>
            <td width="50%"><strong>Motivo :</strong>{{ $referral_guide->reason}}</td>
        </tr>
    </table>
    <br>
    <strong>Datos del transoportista: </strong>
    <table  class="table-client">
        <tr>
            <td width="30%"><strong>RUC :</strong> {{ $referral_guide->carrier_document_number}}</td>
            <td width="70%"><strong>Denominacion, Apellidos y Nombres: </strong> {{ strtoupper ($referral_guide->carrier_name)}}</td>
        </tr>
    </table>

    <br>

    <strong>Datos de la Unidad de Transporte y conductor: </strong>
    <table  class="table-client">
        <tr>
            <td width="33%"><strong>Marca:</strong> {{$referral_guide->brand}}</td>
            <td width="33%"><strong>Placa:</strong> {{$referral_guide->plate}}</td>
            <td width="33%"><strong>Licencia de Conducir:</strong> {{$referral_guide->drive_license_number}}</td>
        </tr>
    </table>
    <br>

    <strong>Datos del bien transportado: </strong>
    <table  class="table-detail">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="10%">Código</th>
                <th width="58%">Descripción</th>
                <th width="5%">UM</th>
                <th width="7%">Cantidad</th>
                <th width="10%">Peso</th>
            </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($referral_guide_detail as $be)
        <tr>
            <td class="text-center">{{ $i}}</td>
            <td class="text-center">{{ $be->code}}</td>
            <td class="text-left">{{ $be->name}} - {{ $be->presentation}} 1</td>
            <td class="text-center">{{ $be->unit_measure}}</td>
            <td class="text-center">{{ $be->quantity}}</td>
            <td class="text-right">{{ $be->weight_total}}</td>
        </tr>
        @php
            $i++;
        @endphp
        @endforeach
        </tbody>
    </table>

    <table class="table-payment" >
        <tr>
            <td width="100%" align="center">
                @php
                $png = QrCode::format('png')->size(100)->generate($name_qr);
                $png = base64_encode($png);
                @endphp
                <img src='data:image/png;base64," {{$png}} "'>
            </td>
          
        </tr>
    </table>

</body>
</html>