@php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
switch ($sale->type_invoice) {
    case '03': $voucher_type = "BOLETA DE VENTA ELECTRÓNICA"; break;
    case '01': $voucher_type = "FACTURA ELECTRÓNICA"; break;
    case '07': $voucher_type = "NOTA DE CRÉDITO ELECTRÓNICA"; break;
    case '08': $voucher_type = "NOTA DE DÉBITO ELECTRÓNICA"; break;
    case 'NV': $voucher_type = "NOTA DE VENTA"; break;
    case 'NS': $voucher_type = "NOTA DE SERVICIO"; break;
    
    default: $voucher_type = ""; break;
}

$payment_type = '';
switch ($sale->payment_type) {
    case '01': $payment_type = 'CONTADO'; break;
    case '03': $payment_type = 'CRÉDITO'; break;
    default: $payment_type = ''; break;

}
$coin = '';
switch ($sale->coin) {
    case 'PEN': $coin = 'SOLES'; $coin_code = 'S/'; break;
    case 'USD': $coin = 'DOLARES ESTADOUNIDENSES'; $coin_code = '$'; break;
    case 'CLP': $coin = 'PESOS CHILENOS'; $coin_code = '$'; break;
    default: $coin = ''; break;

}
$document_type = '';
switch ($client->document_type) {
    case '1': $document_type = 'DNI'; break;
    case '6': $document_type = 'RUC'; break;
    case '4': $document_type = 'CARNET DE EXTRANJERIA'; break;
    case '7': $document_type = 'PASAPORTE'; break;
    case '0': $document_type = 'OTROS'; break;
    default: $document_type = ''; break;

}

$name_qr = $business->document_number.'|'.$sale->type_invoice.'|'.$sale->serie.'|'.$sale->number.'|'.$sale->igv.'|'.$sale->total.'|'.$sale->broadcast_date.'|'.$client->document_type.'|'.$client->document_number.'|'.$sale->hash_cpe;

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
                            <th class="text-center bg-name-voucher">{{$voucher_type }}</th>
                        </tr>
                        <tr>
                            <th class="text-center">{{$sale->serie }}-{{$sale->number }}</th>
                        </tr>
                    </thead>
                    
                </table>
            </td>
        </tr>
    </table>

    <table  class="table-client">
        <tr>
            <td width="70%" ><strong>Cliente :</strong> {{ strtoupper ($client->name)}}</td>
            <td width="30%"><strong>Fecha Emision </strong> : {{ $sale->broadcast_date}}</td>
        </tr>
        <tr>
            <td width="70%" ><strong>{{ $document_type}} :</strong>  {{ $client->document_number}}</td>
            <td width="30%"><strong>Fecha de Vcto :</strong>  {{ $sale->expiration_date}}</td>
        </tr>
        <tr>
            <td width="100%" colspan="2" ><strong>Dirección:</strong> {{ $client->address}}</td>
        </tr>
        <tr>
            <td width="70%" ><strong>Condicion de Pago :</strong>  {{ $payment_type}}</td>
            <td width="30%"><strong>Moneda :</strong>  {{ $coin}}</td>
        </tr>
    </table>


    <table  class="table-detail">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="10%">Código</th>
                <th width="58%">Descripción</th>
                <th width="5%">UM</th>
                <th width="7%">Cantidad</th>
                <th width="10%">P. Unit</th>
                <th width="10%">P. Total</th>
            </tr>
        </thead>
        <tbody>
        @php
        $i = 1;
        @endphp
        @foreach ($sale_detail as $be)
        <tr>
            <td class="text-center">{{ $i }}</td>
            <td class="text-center">{{ $be->code }}</td>
            <td class="text-left">{{ $be->name }}</td>
            <td class="text-center">{{ $be->unit_measure }}</td>
            <td class="text-center">{{ $be->quantity }}</td>
            <td class="text-right">{{ $be->unit_price }}</td>
            <td class="text-right">{{ $be->total_price }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <table class="table-total">
        <tr>
            <td>{{ strtoupper($sale->number_to_letters)}}</td>
        </tr>
    </table>

    <table class="table-payment" >
            <tr>
                <td width="20%" align="center">
                    @php
                    $png = QrCode::format('png')->size(100)->generate($name_qr);
                    $png = base64_encode($png);
                    @endphp
                    <img src='data:image/png;base64," {{$png}} "'>
                </td>
                <td width="45%" align="center">
                    
                </td>
                <td width="35%" align="center">
                    <table width="100%" >
                        <tr>
                            <td width="45%" class="text-left">Ope. Gravadas</td>
                            <td width="20%" class="text-center">: {{ $coin_code }}</td>
                            <td width="35%" class="text-right">{{ $sale->taxed_operation }}</td>
                        </tr>
                        <tr>
                            <td width="45%" class="text-left">Ope. Exoneradas</td>
                            <td width="20%" class="text-center">: {{ $coin_code }}</td>
                            <td width="35%" class="text-right">{{ $sale->exonerated_operation }}</td>
                        </tr>
                        <tr>
                            <td width="45%" class="text-left">Ope. Inafectas</td>
                            <td width="20%" class="text-center">: {{ $coin_code }}</td>
                            <td width="35%" class="text-right">{{ $sale->unaffected_operation }}</td>
                        </tr>
                        <tr>
                            <td width="45%" class="text-left">I.G.V.</td>
                            <td width="20%" class="text-center">: {{ $coin_code }}</td>
                            <td width="35%" class="text-right">{{ $sale->igv }}</td>
                        </tr>
                        <tr>
                            <td width="45%" class="text-left">Total</td>
                            <td width="20%" class="text-center">: {{ $coin_code }}</td>
                            <td width="35%" class="text-right">{{ $sale->total }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        @if (!empty($business->description))
        <table  class="table" >
            <tr>
                <td width="100%" align="center" >
                    <br>
                    {{ $business->description }}
                </td>
            </tr>
        </table>
        @endif
        

        <table  class="table" >
            <tr>
                <td width="100%" align="center" >
                    <br>
                    Esta es una representación impresa de la {{ ucfirst($voucher_type) }}. Puede consultar en {{ $business->url_cpe }}
                </td>
            </tr>
        </table>

        
        

</body>
</html>