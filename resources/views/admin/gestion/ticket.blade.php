<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/estilo-impresion.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('/js/script.js') }}"></script>
    </head>
    <body>
        <div class="ticket">


            <p class="centrado observacion">PEDIDO #{{ $cart->id }}<br>
              Cliente: {{ $cart->cliente->name}}<br>
              Para las {{ $cart->horario }}Hs<br>
              Entrega tipo {{ $cart->entrega_tipo }}<br>
              @if($cart->entrega_tipo == "delivery")
                Direccion {{ $cart->direccion }}
              @endif
            </p>
            <table>
                <thead>
                    <tr>
                        <th class="codigo">Cod</th>
                        <th class="cantidad">Cant</th>
                        <th class="observacion">Detalles</th>
                        <th class="precio">Unit.</th>
                    </tr>
                </thead>
                @foreach($cart->details as $detail)
                <tbody>
                    <tr>
                        <td class="codigo">{{ $detail->producto->codigo }}</td>
                        <td class="cantidad">{{ $detail->quantity }}</td>
                        <td class="observacion">{{ $detail->observacion }}</td>
                        <td class="precio">$ {{ $detail->producto->precio }}</td>
                    </tr>
                </tbody>
                @endforeach
                <td></td>
                
                <td class="precio">Total</td>
                <td class="observacion">$ {{ $cart->total }}</td>
            </table>

            @if($cart->entrega_tipo == "delivery")
              <p>DELIVERY INCLUIDO</p>
            @endif
            <p class="centrado">¡GRACIAS POR SU COMPRA!</p>

        </div>
        <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
    </body>
</html>
