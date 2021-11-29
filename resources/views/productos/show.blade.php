@extends('layouts.app')

@section('body-class', 'profile-page')

@section('content')

<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner2.png') }}');"></div>

<div class="main main-raised">
  <div class="profile-content">
          <div class="container">
              <div class="row">
                  <div class="profile">
                      <div class="avatar">
                          <img src="{{ $plato->featured_imagen_url }}" alt="Circle Image" class="img-circle img-responsive img-raised">
                      </div>
                      <div class="name">
                          <h3 class="title">{{ $plato->nombre }}</h3>
                          <h6>{{ $plato->categoria_nombre }}</h6>
                      </div>
                      @if (session('notificacion'))
                          <div class="alert alert-success" role="alert">
                              {{ session('notificacion') }}
                          </div>
                      @endif
                  </div>
              </div>
              <div class="description text-center">
                    <p>{{ $plato->descripcion }}</p>
              </div>

              <div class="text-center">
                <!-- Button trigger modal -->
                @guest
  							@if (Route::has('login'))
                <div class="alert alert-success" role="alert">
                    Para realizar un pedido es necesario iniciar session
                </div>
  					    <li style="list-style: none;">
                  <a class="btn btn-primary btn-round nav-link" href="{{ route('login') }}">
                    <i class="material-icons">login</i> Iniciar session
                  </a>
  					    </li>
                @endif
                @else
                <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#modalAddToCart">
                  <i class="material-icons">add</i> Añadir al pedido
                </button>
                @endif
              </div>

              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <div class="profile-tabs">
                    <div class="nav-align-center">

                      <div class="tab-content gallery">
                        <div class="tab-pane active" id="studio">
                          <div class="row">
                            <div class="col-md-6">
                              @foreach($imagenesIzq as $imagen)
                              <img src="{{ $imagen->url }}" class="img-rounded" />
                              @endforeach
                            </div>
                            <div class="col-md-6">
                              @foreach($imagenesDer as $imagen)
                              <img src="{{ $imagen->url }}" class="img-rounded" />
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Profile Tabs -->
                </div>
              </div>

          </div>
      </div>
</div>

<!-- Modal Core -->
<div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" aria-labelledby="modalAddToCart" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="modalAddToCart">Seleccione la cantidad</h4>
      </div>
      <form method="post" action="{{ url('/cart') }}">
        {{ csrf_field() }}
        <input type="hidden" name="producto_id" value="{{ $plato->id }}">
        <div class="col-sm modal-body">
          <input class="form-control" type="number" min="1" name="quantity" value="1">
          <div class="form-group label-floating">
            <input type="text" class="form-control" name="observaciones" value="" placeholder="Observaciones: sin lechuga, sin sal, con pan arabe, etc">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-info btn-simple">Añadir al pedido</button>
        </div>
      </form>
    </div>
  </div>
</div>

@include('includes.footer')
@endsection
