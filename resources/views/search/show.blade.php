@extends('layouts.app')

@section('body-class', 'profile-page')

@section('styles')
  <style>
    .team {
        padding-bottom: 50px;
    }
    .team .row .col-md4{
        margin-bottom: 5rem;
    }
    .row{
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
    }
    .row > [class*='col-'] {
        display: flex;
        flex-direction: column;
    }
    .minh-100 {
      height: 100vh;
    }
  </style>
@endsection

@section('content')

<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner2.png') }}');"></div>
<div class="main main-raised">
  <div class="profile-content">
          <div class="container">

                  <div class="profile">
                      <div class="avatar">
                          <img src="/imagenes/lupa.png" alt="Imagen representativa de la busqueda" class="img-circle img-responsive img-raised">
                      </div>
                      <div class="name">
                          <h3 class="title">Resultados de busqueda</h3>
                      </div>
                      @if (session('notificacion'))
                          <div class="alert alert-success" role="alert">
                              {{ session('notificacion') }}
                          </div>
                      @endif
                  </div>

              <div class="description text-center" style="margin-top: 0px;">
                  <p>Se encontraron {{ $productos->count() }} resultados para el término {{ $query }}</p>
              </div>

              <div class="team text-center" style="margin-top: 0px;padding-bottom: 0px;">
                <div class="container">
                  <!-- <div class="row" style="justify-content: center;">
                    @foreach ($productos as $producto)
                    <div class="col-md-4">
                      <div class="team-player" style="margin-top: 20px;">
                        <a href="{{ url('platos/'.$producto->id) }}">
                          <img src="{{ $producto->featured_imagen_url }}" alt="Imagen no encontrada" class="img-circle img-raised">
                        </a>
                        <h4 class="title" style="margin-bottom: 5px;margin-top: 15px;">
                          <a href="{{ url('platos/'.$producto->id) }}">{{ $producto->nombre }}</a>
                        </h4>
                        <p class="description" style="margin-top: 5px;">{{ $producto->descripcion }}</p>
                      </div>
                    </div>
                    @endforeach
                  </div> -->
                  <div class="row" style="justify-content: center;">
                    @foreach ($productos as $producto)
                    <div class="col-md-6 col-xs-12">
                      <div class="card" style="width: 100%;border-radius: 10px;background-color: #019345;margin-top: 20px;">
                        <a href="{{ url('platos/'.$producto->id) }}" style="text-decoration:none;">
                            <h4 class="title" style="margin-bottom: 5px;margin-top: 10px;">
                              {{ $producto->nombre }}
                            </h4>
                            <p class="description" style="color: #FFFEFE;margin-bottom: 10px;margin-top: 5px;">{{ $producto->descripcion }}</p>
                        </a>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
                <!--<div class="text-center mt-10" style="padding-top: 20px;">
                    {{ $productos->links() }}
                </div>-->
              </div>

              <div class="text-center" style="margin-bottom: 10px;margin-top: 10px;">
                <a class="btn btn-primary btn-round btn" href="{{ url('/') }}" style="color: #FFFEFE;background-color: #019345;">
                  <i class="material-icons">reply</i> Volver
                </a>
              </div>

          </div>
      </div>
</div>

@include('includes.footer')
@endsection
