@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner1.png') }}');">
</div>
<div class="main main-raised">
  <div class="container">
    <div class="section">
      <h2 class="title text-center">Editar plato seleccionado </h2>

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        <form method="POST" action="{{ url('/admin/platos/'.$producto->id.'/edit') }}">
            @csrf
                <div class="row">
                  <div class="col-sm-4">
                  	<div class="form-group label-floating">
                  		<label class="control-label">Nombre del plato</label>
                  		<input type="text" class="form-control" name="name"
                        value="{{ old('name', $producto->nombre) }}">
                  	</div>
                  </div>

                  <div class="col-sm-4">
                  	<div class="form-group label-floating">
                  		<label class="control-label">Codigo</label>
                  		<input type="number" class="form-control" name="code"
                        value="{{ old('code', $producto->codigo) }}">
                  	</div>
                  </div>

                  <div class="col-sm-4">
                  	<div class="form-group label-floating">
                  		<label class="control-label">Precio</label>
                  		<input type="number" step="0.01" class="form-control" name="price"
                        value="{{ old('price', $producto->precio) }}">
                  	</div>
                  </div>

                  <div class="col-sm-2">
                  	<div class="form-group label-floating">
                  		<label class="control-label">Sector de elaboración</label>
                  		<input type="number" step="1" class="form-control" name="sector"
                        value="{{ old('sector', $producto->sector) }}">
                  	</div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group label-floating">
                      <label class="control-label">Categoria</label>
                      <select class="form-control" name="categoria_id">
                        <option value="0">Sin categoria</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @if($categoria->id == old('categoria_id', $producto->categorias_id)) selected @endif>
                          {{ $categoria->nombre }}</option>
                        @endforeach
                      </select>
                      </div>
                  </div>

                  <div class="col-sm-8">
                    <div class="form-group label-floating">
                      <label class="control-label">Descripcion</label>
                      <input type="text" class="form-control" name="descripcion"
                        value="{{ old('descripcion', $producto->descripcion) }}">
                    </div>
                  </div>
                </div>


            <!--<textarea class="form-control" placeholder="{{ $producto->l_descripcion }}"
              rows="5" name="descripcion"></textarea>

            Falta agregar la l_descripcion de los platos
            <textarea class="form-control" placeholder="{{ $producto->l_descripcion }}" rows="5" name="descripcion"></textarea>
            -->
            <button class="btn btn-primary">Guardar cambios</button>
            <a href="{{ url('/admin/platos') }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
  </div>
</div>



@include('includes.footer')
@endsection
