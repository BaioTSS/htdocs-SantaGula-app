<!DOCTYPE html>
<html>
    <head>
        <link href="{{ public_path('/css/style.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ public_path('/js/script.js') }}"></script>
    </head>
    <body>
        <div class="ticket">

            <p class="centrado">TICKET DE PRUEBA<br>San Carlos Centro<br>26/11/2021
                00:39 a.m.</p>
            <table>
                <thead>
                    <tr>
                        <th>CANT</th>
                        <th>PRODUCTO</th>
                        <th>$$</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>LOMOS</td>
                        <td>$750</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>HAMBURGUESAS</td>
                        <td>$700</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>PIZZAS</td>
                        <td>$1400</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>TOTAL</td>
                        <td>$2850</td>
                    </tr>
                </tbody>
            </table>
            <p class="centrado">¡GRACIAS POR SU COMPRA!<br>SantaGula</p>
            <p class="centrado">¡EL 2022 ES CON FRANQUICIA!<br>y con BaioTSS AR</p>
        </div>
        <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
    </body>
</html>
