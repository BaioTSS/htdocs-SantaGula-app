@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner1.png') }}');">

</div>

<div class="main main-raised">
  <div class="container">
      <div class="section text-center" style="padding-top: 0px;">
        <h2 class="title">Configuraciones</h2>
        <ul class="nav nav-tabs" style="background: #000000;padding-top: 10px;padding-bottom: 10px;padding-left: 10px;padding-right: 10px;">
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/ventas') }}">
              <span class="material-icons">attach_money</span>
              Ventas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/enespera') }}">
              <span class="material-icons">event_note</span>
              En espera
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/cocinando') }}">
              <span class="material-icons">restaurant_menu</span>
              Cocinando
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/delivery') }}">
              <span class="material-icons">delivery_dining</span>
              Delivery
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/takeaway') }}">
              <span class="material-icons">store</span>
              Takeaway
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/config') }}">
              <span class="material-icons">settings</span>
              Config
            </a>
          </li>
        </ul>
        <hr style="margin-bottom: 5px;">
        <div class="team" style="margin-top: 5px;">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="alert alert-danger" style="border-radius: 10px;padding-right: 10px;padding-left: 10px;margin-left: 10px;margin-right: 10px;">
                <h3>Horarios</h3>
                <table class="table-flex">
                    <thead>
                      <tr>
                        <th class="text-left" scope="col">Hora</th>
                        <th class="text-center" scope="col">Carritos disponibles</th>
                        <th class="text-center" scope="col">Actualizar</th>
                      </tr>
                    </thead>
                    @foreach($turnos as $turno)
                    <tbody>
                      <form method="POST" action="{{ url('/admin/gestion/config') }}">
                      <tr>
                        <td class="text-left">{{ $turno->horarios }}</td>
                        @csrf
                        <td class="text-right">
                          <div class="form-control" style="padding-left: 6px;">
                            <input type="number" min="0" name="cupos" value="{{ $turno->cupos }}">
                          </div>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-primary btn-round" type="submit" name="turno_id" value="{{ $turno->id }}">
                          	<i class="material-icons">published_with_changes</i>
                          </button>
                        </form>
                        </td>
                      </tr>
                    </tbody>
                    @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

@include('includes.footer')
@endsection
