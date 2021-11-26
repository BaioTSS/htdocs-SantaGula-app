<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="{{ public_path('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ public_path('/css/material-kit.css') }}" rel="stylesheet" type="text/css"/>
  </head>
  <body>
    Hola mundo
    <p>Caja actual: {{ $ultimaCaja->dia }}</h>
    <h4>Total caja</h4>
    <h5>$ {{ $ultimaCaja->total }}</h5>

    <table class="table">
      <thead>
        <tr>
          <th class="text-left" scope="col">Plato</th>
          <th class="text-center" scope="col">Codigo</th>
          <th class="text-left" scope="col">Cantidad</th>
        </tr>
      </thead>
      @foreach ($ventas as $venta)
      <tbody>
        <tr>
          <td class="text-left">{{ $venta->nombre }}</td>
          <td class="text-center">{{ $venta->producto_code }}</td>
          <td class="text-left">{{ $venta->cantidades }}</td>
        </tr>
      </tbody>
      @endforeach
    </table>
    <h4>Cantidad de pedidos entregados: {{ $cartsEntregados }}</h4>
    <h4>Pedidos con delivery</h4>
    <p>{{ $cartsEntrDelivery }}</p>
    <h4>Pedidos por takeaway</h4>
    <p>{{ $cartsEntrTakeaway }}</p>
  </body>
</html>
