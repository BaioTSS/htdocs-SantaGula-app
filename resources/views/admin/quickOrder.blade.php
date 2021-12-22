@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner1.png') }}');">

</div>

<div class="main main-raised">
  <div class="container">
      <div class="section text-center" style="padding-top: 0px;">
        <h2 class="title">Quick-Order</h2>

        <div class="team" style="margin-top: 0px;">
          <div class="row">
              <form class="form-inline text-left" method="get" action="{{ url('/admin/quick-order') }}"  style="justify-content: center;">
                <div class="form-group mx-sm-3 mb-2" style="margin-top: 13px;padding-right: 7px;">
                  <input class="form-control" type="text" placeholder="busqueda rápida" name="query" id="search">
                </div>
                <button class="btn btn-primary btn-just-icon" type="submit" aria-haspopup="true" aria-expanded="false" style="background-color: #019345;">
                    <i class="material-icons">search</i>
                </button>
              </form>

              <div class="section" style="padding-bottom: 0px;padding-top: 0px;">


                @if(session('notificacion'))
                  @if(strcmp (session('notificacion'), 'Tu pedido se ha enviado correctamente' ) == 0)
                    <div class="alert alert-success" role="alert">
                        {{ session('notificacion') }}
                    </div>
                  @elseif(strcmp (session('notificacion'), 'El plato se ha cargado a tu lista de pedidos exitosamente' ) == 0)
                    <div class="alert alert-success" role="alert">
                        {{ session('notificacion') }}
                    </div>
                  @else
                    <div class="alert alert-danger" role="alert">
                        {{ session('notificacion') }}
                    </div>
                  @endif
                @endif

                @if(!empty($query))
                <div class="description text-center" style="margin-top: 0px;">
                    <p>Se encontraron {{ $productos->count() }} resultados para el término {{ $query }}</p>
                </div>

                <div class="team text-center" name="plato" style="margin-top: 0px;padding-bottom: 0px;">
                  <div class="container">
                    <div class="row" style="justify-content: center;">
                      @foreach ($productos as $producto)
                      <div class="col-md-12 col-xs-12" style="width: 100%;border-radius: 10px;background-color: #019345;margin-top: 20px;padding-right: 0px;">
                        <div class="col-md-4 text-left">
                          <h4 class="title" style="margin-bottom: 5px;margin-top: 10px;">
                            {{ $producto->nombre }}
                          <h6 class="title" style="margin-bottom: 5px;margin-top: 10px;">
                            Codigo: {{ $producto->codigo }}
                          </h6>
                          <h5 class="title" style="margin-bottom: 10px;margin-top: 5px;">
                            Descripción: {{ $producto->descripcion }}
                          </h5>
                          <h5 class="title" style="margin-bottom: 5px;margin-top: 10px;">
                            ${{ $producto->precio }}
                          </h5>
                        </div>

                        <div class="col-md-8" style="display: flex;padding-right: 0px;">
                          <div class="modal-content" style=" width: 100%;border-radius: 0px 10px 10px 0px;">
                            <div class="row">
                              <form method="post" action="{{ url('/cart') }}">
                                {{ csrf_field() }}
                                <div class="col-sm-8">
                                  <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                  <div class="col-sm modal-body" style="padding-top: 0px;padding-bottom: 0px;">
                                    <input class="form-control" type="number" min="1" name="quantity" value="1">
                                    <div class="form-group label-floating">
                                      <input type="text" class="form-control" name="observaciones" value="" placeholder="Observaciones: sin lechuga, sin sal, con pan arabe, etc">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-4"  style="display: flex;">
                                  <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-round" style="background-color: #019345;">
                                      Añadir al pedido
                                    </button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                  <div class="text-center mt-10" style="padding-top: 20px;">
                      {{ $productos->links() }}
                  </div>
                </div>
                @endif

                <hr style="margin-top: 40px;">

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                        <tr>

                            <!--<th class="text-center"></th> IMAGEN-->
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
                        <!--  <td class="text-center">
                              <img src="{{ $detail->producto->featured_imagen_url }}" height="50" alt="No posee imagen">
                          </td>  IMAGEN-->
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
                            <form method="post" action="{{ url('/admin/quick-order') }}">
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

                @if(auth()->user()->cart->details->count() == 1)
                  <p class="text-left"> Tu pedido presenta {{ auth()->user()->cart->details->count() }} plato.</p>
                @else
                  <p class="text-right"> Tu pedido presenta {{ auth()->user()->cart->details->count() }} platos.</p>
                @endif

                <div class="text-center">
                  <form method="post" action="{{ url('/admin/quick-order') }}">
                    @csrf
                    <div class="container">
                      <div class="row">

                        <div class="col-sm-4">
                          <div class="row">
                            <div class="form-group label-floating" style="margin-top: 0px;">
                              <div style="display: flex;justify-content: left;align-items: center;">
                                <div class="row">
                                  <div class="col-sm-12 text-left" style="margin-bottom: 10px;">
                                    <p>Responsable:</p>
                                    <input type="text" name="no_user" placeholder="A nombre de.." value="">
                                  </div>
                                  <div class="col-sm-12 text-center" style="display: flex;align-items: center;">
                                    <i class="control-label material-icons">schedule</i>
                                    <div class="mt-1" style="margin-left: 10px;">Horario</div>
                                    <select class="form-control text-center" name="horario">
                                      @foreach($turnos as $turno)
                                        <option value="{{ $turno->horarios }}">{{ $turno->horarios }}</option>
                                      @endforeach
                                      @if(empty($turno))
                                        <option value="false">No disponible</option>
                                      @endif
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-4">
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
                            <div class="col-sm-12" id="localidad">
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

                        <div class="col-sm-4">
                          <div class="row">
                            <div class="col-sm-12">
                              <h4><strong>Importe a pagar:</strong> $ {{ auth()->user()->cart->getTotal() }}
                                      <label id="sumaDelivery"> + $100 (delivery)</label>
                              </h4>
                              </div>
                            <div class="col-sm-12">
                              <button class="btn btn-primary btn-round" style="background-color: #019345;">
                                <i class="material-icons">done</i> Confirmar pedido
                              </button>
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
                      </div>
                    </div>
                  </form>
                </div>

              </div>



          </div>
        </div>
      </div>
  </div>
</div>

@include('includes.footer')
@endsection

@section('scripts')
    <script src="{{ asset('/js/typeahead.bundle.js') }}"></script>
    <script>
          $(function (){
              //
              var productos = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: '{{ url("/platos/json") }}'
              });
              //inicializamos el typehead sobre nuestro input de busqueda
              $('#search').typeahead({
                  hint: true,
                  highlight: true,
                  minLength: 1
              }, {
                  name: 'productos',
                  source: productos
              });
          });
    </script>
@endsection
