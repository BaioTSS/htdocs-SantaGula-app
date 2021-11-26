@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner1.png') }}');">

</div>

<div class="main main-raised">
  <div class="container">
      <div class="section text-center">
        <h2 class="title">Imagenes de {{ $producto->nombre }}</h2>
        <form method="post" action="" enctype="multipart/form-data"> <!-- Con el action vacio se asume que la peticion se hace a la url abierta -->
          @csrf
          <input type="file" name="foto" required>
          <button type="submit" class="btn btn-primary btn-round">Subir nueva imagen</button>
          <a href="{{ url('/admin/platos')}}" class="btn btn-default btn-round">
            Volver a la lista de platos
          </a>
        </form>

        <hr>

        <div class="row">
          @if (is_array($imagenes) || is_object($imagenes))
            @foreach ($imagenes as $imagen)
              <div class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <img src="{{ $imagen->url }}" width="250">
                    <form method="post" action="">
                      @csrf
                      {{ method_field('DELETE') }}
                      <input type="hidden" name="imagen_id" value="{{ $imagen->id }}">
                      <button type="submit" class="btn btn-danger btn-round mt-2">Eliminar</button>
                      @if ($imagen->featured)
                        <button type="button" class="btn btn-danger btn-fab btn-fabmini btn-round mt-2" rel="tooltip" title="Imagen destacada del plato">
                            <i class="material-icons">favorite</i>
                        </button>
                      @else
                        <a href="{{ url('/admin/platos/'.$producto->id.'/imagenes/select/'.$imagen->id) }}" class="btn btn-white btn-fab btn-fabmini btn-round mt-2">
                            <i class="material-icons">favorite</i>
                        </a>
                      @endif
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
  </div>
</div>

@include('includes.footer')
@endsection
