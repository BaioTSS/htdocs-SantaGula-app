<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<!--<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../assets/img/favicon.png">-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Santa Gula</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- CSS Files -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/material-kit.css') }}" rel="stylesheet"/>
		@yield('styles')

</head>

<body class="@yield('body-class')">
	<nav class="navbar navbar-transparent navbar-absolute">
    	<div class="container">
        	<!-- Brand and toggle get grouped for better mobile display -->
        	<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
        		</button>
        		<a class="navbar-brand" href="{{ url('/')}}">Santa Gula</a>
        	</div>

        	<div class="collapse navbar-collapse" id="navigation-example">
        		<ul class="nav navbar-nav navbar-right">
							<!-- Authentication Links -->
							@guest
							@if (Route::has('login'))
					    <li>
					        <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
					    </li>
							@endif
							@if (Route::has('register'))
					    <li>
					        <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarme') }}</a>
					    </li>
							@endif
							@else
							<li class="nav-item dropdown">

										<a class="nav-link dropdown-toggle" href="{{ url('/home') }}">
												Mis pedidos
										</a>


										<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								    		{{ Auth::user()->name }}
								    </a>



							    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									@if (auth()->user()->admin == 1)
									<li>
										<a class="dropdown-item" href="{{ url('/admin/quick-order') }}">
						            Quick-Order
						        </a>
									</li>
									<li>
										<a class="dropdown-item" href="{{ url('/admin/categorias') }}">
						            Gestionar categoriorias
						        </a>
									</li>
									<li>
										<a class="dropdown-item" href="{{ url('/admin/platos') }}">
						            Gestionar Platos
						        </a>
									</li>
									<li>
										<a class="dropdown-item" href="{{ url('/admin/gestion/ventas') }}">
						            Gestion
						        </a>
									</li>
									@endif
									@if (auth()->user()->admin == 2)
									<li>
										<a class="dropdown-item" href="{{ url('/admin/gestion/cocinando') }}">
						            Delivery
						        </a>
									</li>
									@endif
									<li>
										<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						           Cerrar Sesión
						        </a>
						        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						            @csrf
						        </form>
									</li>
							    </ul>
							</li>
							@endguest
        		</ul>
        	</div>
    	</div>
    </nav>

    <div class="wrapper">
      @yield('content')
    </div>


</body>
	<!--   Core JS Files   -->
	<script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/material.min.js') }}"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="{{ asset('/js/nouislider.min.js') }}" type="text/javascript"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="{{ asset('/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="{{ asset('/js/material-kit.js') }}" type="text/javascript"></script>

	@yield('scripts')
</html>
