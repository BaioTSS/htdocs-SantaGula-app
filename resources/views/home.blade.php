@extends('layouts.app')

@section('body-class', 'info-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner2.png') }}');">
</div>

<div class="main main-raised">
  <div class="container">
    <div class="section" style="padding-bottom: 10px;padding-top: 10px;">
      <h3 class="title text-center">Mis Pedidos</h3>

      @if (session('notificacion'))
          <div class="alert alert-success" role="alert">
              {{ session('notificacion') }}
          </div>
      @endif

      <ul class="nav nav-tabs" style="background: #008c45;padding-top: 10px;padding-bottom: 10px;padding-left: 10px;padding-right: 10px;">
        <li class="nav-item active">
          <a class="nav-link" data-bs-toggle="tab" href="{{ url('/home') }}">
            <span class="material-icons">add_shopping_cart</span>
            Carrito
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="{{ url('/mispedidos') }}">
            <span class="material-icons">shopping_cart_checkout</span>
            Estado
          </a>
        </li>
      </ul>
      <hr>
      @if(auth()->user()->cart->details->count() == 1)
        <p> Tu pedido presenta {{ auth()->user()->cart->details->count() }} plato.</p>
      @else
        <p> Tu pedido presenta {{ auth()->user()->cart->details->count() }} platos.</p>
      @endif


      <div class="table-responsive">
      <table class="table">
        <thead>
            <tr>

                <th class="text-center"></th>
                <th class="col-md-2 text-left">Plato</th>
                <th class="col-md-2 text-left">Observaciones</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Subtotal</th>
                <th class="col-md-3 text-center">Opciones</th>
            </tr>
        </thead>
        <tbody>
          @foreach(auth()->user()->cart->details as $detail)
          <tr>
              <td class="text-center">
                  <img src="{{ $detail->producto->featured_imagen_url }}" height="50" alt="No posee imagen">
              </td>
              <td class="col-md-2 text-left" style="vertical-align: middle;">
                <a href="{{ url('/platos/'.$detail->producto->id) }}" target="_blank">
                  {{ $detail->producto->nombre }}
                </a>
              </td>
              <td class="col-md-4 text-left" style="vertical-align: middle;">
                  @if($detail->observacion == NULL)

                  @else
                    {{ $detail->observacion }}
                  @endif
              </td>
              <td class="text-center" style="vertical-align: middle;">
                $ {{ $detail->producto->precio }}
              </td>
              <td class="text-center" style="vertical-align: middle;">
                {{ $detail->quantity }}
              </td>
              <td class="text-center" style="vertical-align: middle;">
                $ {{ $detail->quantity * $detail->producto->precio }}
              </td>
              <td class="col-md-3 text-center td-actions text-right">
                <form method="post" action="{{ url('/cart') }}">
                  @csrf
                  {{ method_field('DELETE') }}
                  <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">

                  <a href="{{ url('/platos/'.$detail->producto->id) }}" target="_blank" rel="tooltip" title="Ver Plato" class="btn btn-info btn-simple btn-xs">
                      <i class="fa fa-info"></i>
                  </a>
                  <button type="submit" rel="tooltip" title="Eliminar Plato" class="btn btn-danger btn-simple btn-xs">
                      <i class="fa fa-times"></i>
                  </button>
                </form>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>

      <p><strong>Importe a pagar:</strong> $ {{ auth()->user()->cart->getTotal() }}
              <label id="sumaDelivery"> + $100 (delivery)</label>
      </p>

      <div class="text-center">
        <form method="post" action="{{ url('/order') }}">
          @csrf
          <div class="container">
            <div class="row">

              <div class="col-sm-4">
                <div class="row">
                  <div class="form-group label-floating">
                    <div style="display: flex;justify-content: left;align-items: center;">
                      <div class="col-sm-6" style="display: flex;align-items: center;">

                          <i class="control-label material-icons">schedule</i>
                          <div class="mt-1" style="margin-left: 10px">Horario</div>

                      </div>
                      <div class="col-sm-4">
                        <select class="form-control text-center" name="horario">
                          @foreach($turnos as $turno)
                            <option value="{{ $turno->horarios }}">{{ $turno->horarios }}</option>
                          @endforeach
                          @if(empty($turno))
                            <option value="#">No disponible</option>
                          @endif
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="row">



                  <div class="col-sm-12">
                    <div class="text-left radio" style="display: flex;align-items: center;">
                      <span class="material-icons">
                        delivery_dining
                      </span>
                      <label>
                        <input type="radio" value="Enable" name="deliveryBtn" checked>
                        Delivery
                      </label>
                      <input style="margin-left: 15px;" type="text" name="direccion" placeholder="Domicilio" value="">
                    </div>
                  </div>


                  <div class="col-sm-6" id="localidad">
                    <div class="text-left radio" style="display: flex;align-items: center;">

                      <span class="material-icons">location_on</span>
                      <label style="padding-left: 15px;">Localidad</label>
                      <select class="form control form-select" name="localidad" style="margin-left: 15px;">
                        <option value="San Carlos Centro">San Carlos Centro</option>
                        <option value="San Carlos Sud">San Carlos Sud</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="text-left radio" style="display: flex;align-items: center;">
                      <span class="material-icons">
                      store
                      </span>
                      <label>
                        <input type="radio" value="Disable" name="deliveryBtn">
                        Takeaway (Retiro en local)
                      </label>
                    </div>
                  </div>



                </div>
              </div>

              <script>
                $('input[name="deliveryBtn"]').on('change', function(){
                    $('input[name="direccion"]').prop('hidden',this.value!="Enable")
                    $('#sumaDelivery').prop('hidden',this.value!="Enable");
                    $('#localidad').prop('hidden',this.value!="Enable");
                });
              </script>


              <div class="col-sm-12" style="justify-content: center;">
                <button class="btn btn-primary btn-round" style="background-color: #008c45;">
                  <i class="material-icons">done</i> Confirmar pedido
                </button>
              </div>


            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>


@include('includes.footer')
@endsection
