@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner1.png') }}');">

</div>

<div class="main main-raised">
  <div class="container">
      <div class="section text-center">
        <h2 class="title">Listado de platos disponibles</h2>
        <div class="team">
          <div class="row">
            <a href="{{ url('/admin/platos/create') }}" class="btn btn-primary btn-round">Agregar plato</a>
            <table class="table">
              <thead>
                  <tr>
                      <!--<th class="text-center">#</th>-->
                      <th class="text-center">Codigo</th>
                      <th class="col-md-2 text-left">Plato</th>
                      <th class="col-md-5 text-left">Descripción</th>
                      <th class="text-center">Categoría</th>
                      <th class="text-center">Precio</th>
                      <th class="col-md-3 text-center">Opciones</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td class="text-center">{{ $producto->codigo }}</td>
                    <td class="col-md-2 text-left">{{ $producto->nombre }}</td>
                    <td class="col-md-5 text-left">{{ $producto->descripcion }}</td>
                    <td class="text-center">{{ $producto->categoria_nombre }}</td>
                    <td class="text-center">$ {{ $producto->precio }}</td>
                    <td class="col-md-3 text-center td-actions text-right">
                      <form method="post" action="{{ url('/admin/platos/'.$producto->id) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <a href="{{ url('/platos/'.$producto->id) }}" rel="tooltip" title="Ver Plato" class="btn btn-info btn-simple btn-xs" target="_blank">
                            <i class="fa fa-info"></i>
                        </a>
                        <a href="{{ url('/admin/platos/'.$producto->id.'/edit') }}" rel="tooltip" title="Editar Plato" class="btn btn-success btn-simple btn-xs">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ url('/admin/platos/'.$producto->id.'/imagenes') }}" rel="tooltip" title="Imagen plato" class="btn btn-warning btn-simple btn-xs">
                            <i class="fa fa-image"></i>
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
            {{ $productos->links() }}
          </div>
        </div>
      </div>
  </div>
</div>

@include('includes.footer')
@endsection
