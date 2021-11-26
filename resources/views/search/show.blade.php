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

              <div class="description text-center">
                  <p>Se encontraron {{ $productos->count() }} resultados para el término {{ $query }}</p>
              </div>

              <div class="team text-center">
                <div class="row">
                  @foreach ($productos as $producto)
                  <div class="col-md-4">
                    <div class="team-player">
                      <img src="{{ $producto->featured_imagen_url }}" alt="Imagen no encontrada" class="img-raised img-circle">
                      <h4 class="title">
                        <a href="{{ url('platos/'.$producto->id) }}">{{ $producto->nombre }}</a>
                      </h4>
                      <br>
                      <p class="description">{{ $producto->descripcion }}</p>
                    </div>
                  </div>
                  @endforeach
                </div>
                <div class="text-center mt-10" style="padding-top: 20px;">
                    {{ $productos->links() }}
                </div>
              </div>

          </div>
      </div>
</div>

@include('includes.footer')
@endsection
