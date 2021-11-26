<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('/js/script.js') }}"></script>
    </head>
    <body>
        <div class="ticket">


            <p class="centrado">PEDIDO #{{ $cart->id }}<br>Para las {{ $cart->horario }}Hs<br>San Carlos Centro</p>
            <table>
                <thead>
                    <tr>
                        <th>COD</th>
                        <th>OBSERVACIONES</th>
                        <th>CANT</th>
                        <th>PRECIO</th>
                    </tr>
                </thead>
                @foreach($cart->details as $detail)
                <tbody>
                    <tr>
                        <td>{{ $detail->producto->codigo }}</td>
                        <td>{{ $detail->observacion }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>$ {{ $detail->producto->precio }}</td>
                    </tr>
                </tbody>
                @endforeach
                <td></td>
                <td>TOTAL</td>
                <td>$ {{ $cart->total }}</td>
            </table>

            @if($cart->entrega_tipo == "delivery")
              <p>DELIVERY INCLUIDO</p>
            @endif
            <p class="centrado">¡GRACIAS POR SU COMPRA!<br>SantaGula</p>
            
        </div>
        <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
    </body>
</html>
