@extends('layouts.app')

@section('body-class', 'info-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner2.png') }}');">
</div>

<div class="main main-raised">
  <div class="container">
    <div class="section" style="padding-bottom: 10px;padding-top: 10px;">
      <h3 class="title text-center">Mis Pedidos</h3>

      <ul class="nav nav-tabs" style="background: #008c45;padding-top: 10px;padding-bottom: 10px;padding-left: 10px;padding-right: 10px;">
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="{{ url('/home') }}">
            <span class="material-icons">add_shopping_cart</span>
            Carrito
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" data-bs-toggle="tab" href="{{ url('/mispedidos') }}">
            <span class="material-icons">shopping_cart_checkout</span>
            Pedidos
          </a>
        </li>
      </ul>
      <hr>

      <div class="section text-center" style="padding-bottom: 5px;padding-top: 5px;">
        <div class="team" style="margin-top: 5px;">
          <div class="row">

            @foreach($carts as $cart)
            @if($cart->status == "pendiente" or $cart->status == "cocinando" or $cart->status == "en camino" or $cart->status == "listo")
            <div class="col-sm-4">
              <div class="alert alert-danger" style="border-radius: 10px;padding-right: 10px;padding-left: 10px;margin-left: 10px;margin-right: 10px;background-color: #008c45;">
                <div class="container-fluid">
                  <h4 class="container-fluid text-left">Codigo del pedido #{{ $cart->id }}</h4>

                  @if($cart->status == "pendiente")
                  <div class="alert alert-warning text-left" style="border-radius: 10px;align-items: center;padding-top: 5px;padding-bottom: 5px;background-color: #cd212a;">
                    Tu pedido esta pendiente
                    <span class="material-icons" style="vertical-align: middle;">pending_actions</span>
                  </div>
                  @elseif($cart->status == "cocinando")
                  <div class="alert alert-warning text-left" style="border-radius: 10px;align-items: center;padding-top: 5px;padding-bottom: 5px;background-color: #cd212a;">
                    Tu pedido esta en la cocina
                    <span class="material-icons" style="vertical-align: middle;">restaurant_menu</span>
                  </div>
                  @elseif($cart->status == "en camino")
                  <div class="alert alert-warning text-left" style="border-radius: 10px;align-items: center;padding-top: 5px;padding-bottom: 5px;background-color: #cd212a;">
                    Tu pedido esta en camino
                    <span class="material-icons" style="vertical-align: middle;">delivery_dining</span>
                  </div>
                  @elseif($cart->status == "listo")
                  <div class="alert alert-warning text-left" style="border-radius: 10px;align-items: center;padding-top: 5px;padding-bottom: 5px;background-color: #cd212a;">
                    Tu pedido te esta esperando
                    <span class="material-icons" style="vertical-align: middle;">done_outline</span>
                  </div>
                  @endif

                  <div class="alert alert-warning" style="border-radius: 10px;background-color: #cd212a;">
                    <p class="text-left">Detalles:</p>

                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Plato</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                          </tr>
                        </thead>
                        @foreach($cart->details as $detail)
                        <tbody>
                          <tr>
                            <td>{{ $detail->producto->nombre }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>$ {{ $detail->producto->precio }}</td>
                          </tr>
                        </tbody>
                        @endforeach
                      </table>

                    <p><h6 class="container-fluid text-left">Total: $ {{ $cart->total }}</h6></p>
                  </div>

                  <div class="container-fluid">
                    @if($cart->entrega_tipo == "delivery")
                      <div class="form-floating">
                        <p>Entrega tipo delivery por calle {{ $cart->direccion }} a las {{ $cart->horario }}Hs.</p>
                      </div>
                    @elseif($cart->entrega_tipo == "takeaway")
                      <p>Retiro en SantaGula a las {{ $cart->horario }}Hs.</p>
                    @endif
                  </div>

                  </div>
            	  </div>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


@include('includes.footer')
@endsection
