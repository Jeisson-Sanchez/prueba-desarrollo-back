{{-- {{dd($data)}} --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{"Factura - ".$data->nombre_cliente}}</title>
</head>
<style>
    body {
        /* font-family: "adobe-clean", sans-serif; */
        font-family: Arial, Helvetica, sans-serif;
        color: #353535;
        opacity: 1;
    }
    .tabla1 {
        border: 0px solid black;
        border-collapse: collapse;
        padding: 4px;
    }
</style>
<body>
    <div class="row" style="margin-top: 70px;">
        <h2>Información de compra</h2>
        <br>
        <table width="100%">
            <tr>
                <th style="text-align: left; width:25%">Número de factura</th>
                <td>{{$data->id}}</td>
            </tr>
            <tr>
                <th style="text-align: left; width:25%">Nombre Cliente</th>
                <td>{{$data->nombre_cliente}}</td>
            </tr>
            <tr>
                <th style="text-align: left">Producto</th>
                <td>{{$data->producto["producto"]}}</td>
            </tr>
            <tr>
                <th style="text-align: left">Cantidad</th>
                <td>{{$data->cantidad}}</td>
            </tr>
            <tr>
                <th style="text-align: left">Pago total</th>
                <td>{{$data->precio_total}}</td>
            </tr>
        </table>
    </div>

    <div class="row" style="margin-top: 70px;">
        <h2>Detalle del producto</h2>
        <br>
        <table width="100%">
            <tr>
                <th style="text-align: left; width:20%">Producto</th>
                <td>{{$data->producto["producto"]}}</td>
            </tr>
            <tr>
                <th style="text-align: left; width:25%">Cantidad</th>
                <td>{{$data->producto["cantidad"]}}</td>
            </tr>
            <tr>
                <th style="text-align: left; width:25%">Número de lote</th>
                <td>{{$data->producto["numero_lote"]}}</td>
            </tr>
            <tr>
                <th style="text-align: left; width:25%">Fecha vencimiento</th>
                <td>{{$data->producto["fecha_vencimiento"]}}</td>
            </tr>
            <tr>
                <th style="text-align: left; width:25%">Precio</th>
                <td>{{$data->producto["precio"]}}</td>
            </tr>
        </table>
    </div>
    <br><br><br>
    <footer style="margin-top: 25%; text-align: center;">Factura de prueba</footer>
    
</body>
</html>
