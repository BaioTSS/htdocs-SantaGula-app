@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner1.png') }}');">

</div>

<div class="main main-raised">
  <div class="container">
      <div class="section text-center" style="padding-top: 0px;">
        <h2 class="title">Panel de ventas</h2>
        <ul class="nav nav-tabs" style="background: #000000;padding-top: 10px;padding-bottom: 10px;padding-left: 10px;padding-right: 10px;">
          <li class="nav-item active">
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
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="{{ url('/admin/gestion/config') }}">
              <span class="material-icons">settings</span>
              Config
            </a>
          </li>
        </ul>
        <hr>
        <div class="team">
          <div class="row">
            <div class="col-sm-8 text-left">
              <form method="post" action="{{ url('/admin/gestion/ventas') }}">
                @csrf

                  <div class="col-sm-4 text-left">
                    <p>Caja actual: {{ $ultimaCaja->dia }}</h>
                  </div>
                  <div class="col-sm-4 text-left">
                    <p>Feha nueva caja</p>
                    <input type="text" name="fecha" placeholder="dia/mes/año" value="">
                  </div>
                  <div class="col-sm-4 text-left">
                    <button class="btn btn-primary" type="submit">
                      <i class="material-icons">autorenew</i> Abrir nueva caja
                    </button>
              </form>
                    <a href="{{ url('/admin/gestion/pdf') }}" class="btn btn-danger btn-sm" target="_blank">Generar PDF</a>
                  </div>

            </div>

            <div class="col-sm-4 text-center">
              <div class="alert alert-danger" style="border-radius: 10px;padding-right: 10px;padding-left: 10px;margin-left: 10px;margin-right: 10px;">
                <h4>Total caja</h4>
                <h5>$ {{ $ultimaCaja->total }}</h5>
              </div>
            </div>

            <div class="col-sm-12">
              <hr>
            </div>

            <div class="col-md-6">

              <table class="table">
                <thead>
                  <tr>
                    <th class="text-left" scope="col">Plato</th>
                    <th class="text-center" scope="col">Codigo</th>
                    <th class="text-left" scope="col">Cantidad</th>
                  </tr>
                </thead>
                @foreach ($ventas as $venta)
                <tbody>
                  <tr>
                    <td class="text-left">{{ $venta->nombre }}</td>
                    <td class="text-center">{{ $venta->producto_code }}</td>
                    <td class="text-left">{{ $venta->cantidades }}</td>
                  </tr>
                </tbody>
                @endforeach
              </table>
            </div>

            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-danger" style="border-radius: 10px;padding-right: 10px;padding-left: 10px;margin-left: 10px;margin-right: 10px;">
                    <h4>Cantidad de pedidos entregados: {{ $cartsEntregados }}</h4>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="alert alert-danger" style="border-radius: 10px;padding-right: 10px;padding-left: 10px;margin-left: 10px;margin-right: 10px;">
                    <h4>Pedidos con delivery</h4>
                    <p>{{ $cartsEntrDelivery }}</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="alert alert-danger" style="border-radius: 10px;padding-right: 10px;padding-left: 10px;margin-left: 10px;margin-right: 10px;">
                    <h4>Pedidos por takeaway</h4>
                    <p>{{ $cartsEntrTakeaway }}</p>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
  </div>
</div>

@include('includes.footer')
@endsection
