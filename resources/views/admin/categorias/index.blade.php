@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner1.png') }}');">

</div>

<div class="main main-raised">
  <div class="container">
      <div class="section text-center">
        <h2 class="title">Listado de categorias</h2>
        <div class="team">
          <div class="row">
            <a href="{{ url('/admin/categorias/create') }}" class="btn btn-primary btn-round">Agregar categoria</a>
            <table class="table">
              <thead>
                  <tr>
                      <th class="col-md-2 text-left">Nombre</th>
                      <th class="col-md-5 text-left">Descripción</th>
                      <th class="col-md-3 text-center">Opciones</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($categorias as $categoria)
                <tr>
                    <td class="col-md-2 text-left">{{ $categoria->nombre }}</td>
                    <td class="col-md-5 text-left">{{ $categoria->descripcion }}</td>
                    <td class="col-md-3 text-center td-actions text-right">
                      <form method="post" action="{{ url('/admin/categorias/'.$categoria->id) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <a href="#" rel="tooltip" title="Ver categoria" class="btn btn-info btn-simple btn-xs">
                            <i class="fa fa-info"></i>
                        </a>
                        <a href="{{ url('/admin/categorias/'.$categoria->id.'/edit') }}" rel="tooltip" title="Editar categoria" class="btn btn-success btn-simple btn-xs">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" rel="tooltip" title="Eliminar categoria" class="btn btn-danger btn-simple btn-xs">
                            <i class="fa fa-times"></i>
                        </button>
                      </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $categorias->links() }}
          </div>
        </div>
      </div>
  </div>
</div>

@include('includes.footer')
@endsection
