<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Documento de venta</title>
        <style>
            * {
                font-size: 9px;
                font-family: 'DejaVu Sans', serif;
            }


            .ticket {
                margin: 2px;
            }

            td,
            th,
            tr,
            table {
                border-top: 1px solid black;
                border-collapse: collapse;
                margin: 0 auto;
            }
            th {
                text-align: center;
            }


            .centrado {
                text-align: center;
                align-content: center;
            }

            .ticket {
                width: 165px;
                max-width: 165px;
            }

            img {
                margin: 0 auto;
            }

            * {
                margin: 0;
                padding: 0;
            }

            .ticket {
                margin: 10px;
                padding: 0;
            }

            body {
                text-align: center;
            }
        </style>
    </head>
    <body class="ticket centrado">
        <img src="{{ public_path('assets/img/oromatic-logo.png') }}" alt="Atelier logo" width="150">
        <!-- <p style="line-height: 9px; font-size: 8px; font-weight: bold">
            COMPRA Y VENTA DE METALES <br>
            CENTRO JOYERO MADERO 55, 5TO. PISO D-409<br>
            Centro Joyero No. 55 <br>
            Tel. 55-18-57-70-66<br>
            Cel: 56-34-44-86-03
        </p> -->
        
        <br>
        <p style=" margin-bottom: 10px; font-size: 8px ">{{ \Carbon\Carbon::parse($budget->created_at)->isoFormat('LLLL') }}</p>
        <table style="width: 100%; border-collapse: collapse; font-size: 8px">
            <tr>
                <td style=" border-collapse: collapse;">Cliente:</td>
                <td style=" border-collapse: collapse;text-align: right;">{{ $budget->customer->nombre }} {{ $budget->customer->apellido }}</td>
            </tr>
            <tr>
                <td style=" border-collapse: collapse;">Tlf:</td>
                <td style=" border-collapse: collapse;text-align: right;">{{ $budget->customer->telefono }} </td>
            </tr>
            <tr>
                <td style=" border-collapse: collapse;">Recibo N°:</td>
                <td style=" border-collapse: collapse;text-align: right;">{{ $budget->id }}</td>
            </tr>
            <tr>
                <td style=" border-collapse: collapse;">Monto de Pres.:</td>
                <td style=" border-collapse: collapse;text-align: right;">{{ number_format($budget->total, 0, '.', ',') }}</td>
            </tr>
            <tr>
                <td style=" border-collapse: collapse;">Abono USD:</td>
                <td style=" border-collapse: collapse;text-align: right;">{{ number_format($payment->amount, 0, '.', ',') }}</td>
            </tr>
            <tr>
                <td style=" border-collapse: collapse;">Abono ARS:</td>
                <td style=" border-collapse: collapse;text-align: right;">{{ number_format($payment->amount_pesos, 0, '.', ',') }}</td>
            </tr>
            <tr>
                <td style=" border-collapse: collapse;">Método de Pago:</td>
                <td style=" border-collapse: collapse;text-align: right;">{{ $payment->payment_method->name }}</td>
            </tr>
            <tr>
                <td style=" border-collapse: collapse;">Tasa del Dólar:</td>
                <td style=" border-collapse: collapse;text-align: right;">{{ $payment->dollar_rate->rate }}</td>
            </tr>
            <tr>
                <td colspan="2" style=" border-collapse: collapse;">Concepto:</td>
            </tr>
            <tr>
                <td colspan="2" style=" border-collapse: collapse;">{{ $payment->concept }}</td>
            </tr>
        </table>

        <br>
        <br>
        <br>
        <br>
        <img src="{{ public_path('assets/img/firma.png') }}" alt="Atelier logo" width="150">
        <br>
        <h1 class="centrado">¡GRACIAS POR SU ABONO!
            <br>
            <strong>¡HASTA PRONTO!</strong>
        </h1>
</body>
</html>
