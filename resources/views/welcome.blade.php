@extends('layouts.app')

@section('body-class', 'landing-page')

@section('styles')
    <style>
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
        .tt-query {
          -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
             -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }

        .tt-hint {
          color: #999
        }

        .tt-menu {    /* used to be tt-dropdown-menu in older versions */
          width: 222px;
          margin-top: 4px;
          padding: 4px 0;
          background-color: #fff;
          border: 1px solid #ccc;
          border: 1px solid rgba(0, 0, 0, 0.2);
          -webkit-border-radius: 4px;
             -moz-border-radius: 4px;
                  border-radius: 4px;
          -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
             -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                  box-shadow: 0 5px 10px rgba(0,0,0,.2);
        }

        .tt-suggestion {
          padding: 3px 20px;
          line-height: 24px;
        }

        .tt-suggestion.tt-cursor,.tt-suggestion:hover {
          color: #fff;
          background-color: #0097cf;

        }

        .tt-suggestion p {
          margin: 0;
        }
    </style>
@endsection

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/banner2.png') }}');">
  <div class="container">
    <div class="row" style="margin-top: -100px;">
      <div class="col-md-6">
        <h1 class="title">SantaGula</h1>
        <h3>El placer de encontrar la diferencia</h3>
      </div>
    </div>
  </div>
</div>

<div class="main main-raised" style="margin-top: -300px;">
  <div>

    <div class="section text-center" style="padding-bottom: 10px;padding-top: 10px;">


      <h2 class="title">Conocé nuestros platos</h2>


      <form class="form-inline row" method="get" action="{{ url('/search') }}"  style="justify-content: center;">
        <div class="form-group mx-sm-3 mb-2" style="margin-top: 13px;padding-right: 7px;">
          <input class="form-control" type="text" placeholder="¿Qué te gustaria cenar hoy?" name="query" id="search">
        </div>
        <button class="btn btn-primary btn-just-icon" type="submit" aria-haspopup="true" aria-expanded="false" style="background-color: #008c45;">
            <i class="material-icons">search</i>
        </button>
      </form>

      <div class="team" style="margin-top: 0px;">
        <div class="row" style="justify-content: center;">
          @foreach ($categorias as $categoria)
          <div class="col-sm-4">
            <div class="team-player" style="margin-top: 20px;">
              <a href="{{ url('categorias/'.$categoria->id) }}">
                <img src="{{ $categoria->featured_imagen_url }}"
                  alt="Imagen representativa de la categoria {{ $categoria->nombre }}" class="img-raised img-circle">
              </a>
              <h4 class="title" style="margin-bottom: 5px;margin-top: 15px;">
                <a href="{{ url('categorias/'.$categoria->id) }}">{{ $categoria->nombre }}</a>
              </h4>
              <p class="description" style="margin-top: 5px;">{{ $categoria->descripcion }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>


    </div>


    <div class="section text-center section-landing">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <h2 class="title">Lo mejor en tu mesa</h2>
          <p class="description">This is the paragraph where you can write more details about your product. Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious, otherwise he wouldn't
            scroll to get here. Add a button if you want the user to see more.
          </p>
        </div>
      </div>
      <!--<div class="features">
        <div class="row">
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-primary">
                <i class="material-icons">chat</i>
              </div>
              <h4 class="info-title">Pedidos online</h4>
              <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-success">
                <i class="material-icons">verified_user</i>
              </div>
              <h4 class="info-title">Second Feature</h4>
              <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-danger">
                <i class="material-icons">fingerprint</i>
              </div>
              <h4 class="info-title">Third Feature</h4>
              <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
            </div>
          </div>
        </div>
      </div>-->
    </div>


  </div>
</div>

@include('includes.footer')
@endsection

@section('scripts')
    <script src="{{ asset('/js/typeahead.bundle.js') }}"></script>
    <script>
          $(function (){
              //
              var productos = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: '{{ url("/platos/json") }}'
              });
              //inicializamos el typehead sobre nuestro input de busqueda
              $('#search').typeahead({
                  hint: true,
                  highlight: true,
                  minLength: 1
              }, {
                  name: 'productos',
                  source: productos
              });
          });
    </script>
@endsection
