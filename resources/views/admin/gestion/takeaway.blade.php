@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner1.png') }}');">

</div>

<div class="main main-raised">
  <div class="container">
      <div class="section text-center" style="padding-top: 0px;">
        <h2 class="title">Listado de pedidos para takeaway</h2>
        <ul class="nav nav-tabs" style="background: #019345;padding-top: 10px;padding-bottom: 10px;padding-left: 10px;padding-right: 10px;">
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/ventas') }}">
              <span class="material-icons">attach_money</span>
              Ventas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/enespera') }}">
              <span class="material-icons">event_note</span>
              En espera
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/cocinando') }}">
              <span class="material-icons">restaurant_menu</span>
              Cocinando
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/delivery') }}">
              <span class="material-icons">delivery_dining</span>
              Delivery
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/takeaway') }}">
              <span class="material-icons">store</span>
              Takeaway
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/config') }}">
              <span class="material-icons">settings</span>
              Config
            </a>
          </li>
        </ul>
        <hr>

        <div class="team">
          <div class="row">

            @foreach($carritos as $cart)
            @if($cart->status == "listo")
            <div class="col-sm-12">
              <div class="alert alert-danger" style="background: #CF2734;border-radius: 10px;padding-right: 10px;padding-left: 10px;margin-left: 10px;margin-right: 10px;">
                <div class="container-fluid">

                    <div class="col-sm-8">
                      <div class="row">
                        <div class="col-sm-4">
                          <p class="container-fluid text-left">Codigo del pedido <strong>#{{ $cart->id }}</strong></p>
                          @if($cart->no_user == null)
                            <p class="container-fluid text-left">Cliente: <strong>{{ $cart->cliente->name }}</strong></p>
                            <p class="container-fluid text-left">WhatsApp: <A HREF="https://wa.me/549{{ $cart->cliente->phone }}" target="_blank"><strong>{{ $cart->cliente->phone }}</strong></A></p>
                          @else
                            <p class="container-fluid text-left">Cliente: <strong>{{ $cart->no_user }}</strong></p>
                          @endif
                        </div>
                        <div class="col-sm-8 text-left">
                          @if($cart->entrega_tipo == "delivery")
                            <div class="form-floating">
                              <p>Entrega tipo <strong>delivery</strong> por calle {{ $cart->direccion }}</p>
                              <p>Para las <strong>{{ $cart->horario }}Hs.</strong></p>
                            </div>
                          @elseif($cart->entrega_tipo == "takeaway")
                            <p>Entraga tipo <strong>takeaway</strong></p>
                            <p>Para las <strong>{{ $cart->horario }}Hs.</strong></p>
                          @endif
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <form method="post" action="{{ url('/admin/gestion/takeaway') }}">
                        <!-- Button trigger modal -->
                        @csrf
                        <div class="col-sm-6">
                          <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#detallesPedido{{ $cart->id }}" style="background: #019345;">
                            <i class="material-icons">visibility</i>  Ver pedido
                          </button>
                        </div>
                        <div class="col-sm-6">
                          <div class="input-group alert-warning" style="border-radius: 3px;background-color: #019345;padding-right: 10px;padding-left: 10px;">
                            <label class="input-group-text" for="mediosDePago" style="color: #FFFEFE"><h4>Medio de cobro</h4></label>
                            <select class="form-select text-center" name="medioDePago" id="mediosDePago" style="color: #019345">
                                <option value="p1_tot">Efectivo</option>
                                <option value="p2_tot">PlusCobros</option>
                                <option value="p3_tot">Devito</option>
                            </select>
                            <button class="btn btn-primary" type="submit" name="cart_id" value="{{ $cart->id }}" style="background: #CF2734;">
                              <i class="material-icons">paid</i>  Entregado
                            </button>
                          </div>
                        </div>

                      </form>
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

@foreach($carritos as $cart)
@if($cart->status == "listo")
<!-- Modal Core -->
<div class="modal fade" id="detallesPedido{{ $cart->id }}" tabindex="-1" role="dialog" aria-labelledby="detallesPedido{{ $cart->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <p class="text-left">Detalles pedido #{{ $cart->id }}:</p>

          <table class="table">
            <thead>
              <tr>
                <th scope="col" class="text-center">Codigo</th>
                <th scope="col" class="text-left">Plato</th>
                <th scope="col" class="text-left">Observaciones</th>
                <th scope="col" class="text-center">Cantidad</th>
                <th scope="col" class="text-center">Precio</th>
              </tr>
            </thead>
            @foreach($cart->details as $detail)
            <tbody>
              <tr>
                <td class="text-center">{{ $detail->producto->codigo }}</td>
                <td class="text-left">{{ $detail->producto->nombre }}</td>
                <td class="text-left">{{ $detail->observacion }}</td>
                <td class="text-center">{{ $detail->quantity }}</td>
                <td class="text-center">$ {{ $detail->producto->precio }}</td>
              </tr>
            </tbody>
            @endforeach
          </table>

        <p>
          <h6 class="container-fluid text-left">Total: $ {{ $cart->total }}
            @if($cart->entrega_tipo == "delivery")
              <strong>delivery</strong> incluido <!--En si esto nunca se va a utilizar en esta secci??n -->
            @endif
          </h6>
        </p>
        <form method="post" action="{{ url('/admin/gestion/pdf') }}" target="_blank">
          @csrf
          <button class="btn btn-primary" type="submit" name="cart_id" value="{{ $cart->id }}">
            <i class="material-icons">input</i>  Generar Ticket
          </button>
        </form>
      </div>


    </div>
  </div>
</div>
@endif
@endforeach

@include('includes.footer')
@endsection
