@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image:  url('{{ asset('/imagenes/fondos/banner1.png') }}');">
</div>

<div class="main main-raised">
  <div class="container">
    <div class="section">
      <h2 class="title text-center">Resgistrar nueva categoria</h2>

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        <form method="post" action="{{ url('/admin/categorias') }}">
            @csrf
                <div class="row">
                  <div class="col-sm-4">
                  	<div class="form-group label-floating">
                  		<label class="control-label">Nombre de categoria</label>
                  		<input type="text" class="form-control" name="name" value="{{ old('name') }}">
                  	</div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group label-floating">
                      <label class="control-label">Descripcion de categoria</label>
                      <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}">
                    </div>
                  </div>

                </div>

            <button class="btn btn-primary">Registrar categoria</button>
            <a href="{{ url('/admin/categorias') }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
  </div>
</div>



@include('includes.footer')
@endsection
