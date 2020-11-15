<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>factura_#{{$bill->id}}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
            border: 1px solid black;
        }

        .invoice table thead tr th {
            border: 1px solid black;
            text-align: left;
        }

        .invoice table tbody tr td{
            border: 1px solid black;
            padding: 10px;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #18a689;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
        .qr-title {
            float: right;
        }
        .qr {
            float: right;
            margin-top: 5%; 
            margin-right: 5%;
        }
    </style>

</head>
<body>

    <div class="information">
        <table width="100%">
            <tr>
                <td align="left" style="width: 40%;">
                    <h3>{{$bill->client->name}}</h3>
<pre>
{{$bill->client->address}} - CP #{{$bill->client->zip_code}}
email: {{$bill->client->email}}
rfc: {{$bill->client->rfc}}
<br /><br />
Date: {{$bill->created_at->format('Y-m-d')}}
CDFI: {{$bill->razon_social}}
Estado: Pagada
</pre>

                </td>
                <td align="center">
                     <img src="{{public_path()}}/img/logo.png" alt="Logo" width="200" class="logo"/>
                </td>
                <td align="right" style="width: 40%;">

                    <h3>Restaurante</h3>
                    <pre>
                        Diana Laura, Justicia #342
                        La paz, Baja California Sur
                        612-234-3455
                        Mexico
                    </pre>
                </td>
            </tr>

        </table>
    </div>

    <br/>

    <div class="invoice">
    <h3>Información de la compra</h3>
    <table width="100%">
        <thead>
        <tr>
            <th>Cantidad</th>
            <th>Descripcion</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bill->dishes as $dish)
            <tr>
                <td>{{$dish->pivot->quantity}}</td>
                <td>{{$dish->description}}</td>
                <td align="left">${{number_format($dish->price,2)}}</td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
        <tr>
            <td colspan="1"></td>
            <td align="right">
                <label>Sub-total:</label> 
            </td>
            <td align="left" class="gray">
                <label>${{number_format($bill->total_amount,2)}}</label>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td align="right">
                <label>IVA(16%):</label> 
            </td>
            <td align="left" class="gray">
                <label>${{number_format($bill->iva,2)}}</label>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td align="right">
               <label>TOTAL:</label> 
            </td>
            <td align="left" class="gray">
                <label>${{number_format($bill->final_total,2)}}</label>
            </td>
        </tr>
        </tfoot>
    </table>

    <div class="qr">
        <img src="{{public_path()}}/qrcodes/factura_{{$bill->id}}.svg" width="200">
    </div>
    
</div>

    <div class="information" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; {{ date('Y') }} - Proyecto Sistemas Concurrentes.
                </td>
                <td align="right" style="width: 50%;">
                    Restaurante
                </td>
            </tr>

        </table>
    </div>

</body>
</html>