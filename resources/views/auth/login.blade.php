@extends('layouts.app')

@section('body-class', 'signup-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/log.png') }}'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="card card-signup">
							<form class="form" method="POST" action="{{ route('login') }}">
                @csrf
								<div class="header header-primary text-center" style="background: #019345;">
									<h4>Inicio de Sesión</h4>
								</div>

								<div class="content">

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
                    <input id="email" type="email" placeholder="Email..." class="
                    form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
										@error('email')
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
									</div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
                    <input id="password" type="password" placeholder="Contraseña..." class="
                    form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
										@error('password')
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
									</div>

									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
											Recordar sesión
										</label>
									</div>

								</div>
								<div class="text-center" style="margin-top: 10px;margin-bottom: 10px;">
									<a href="{{ route('register') }}" style="color: #019345;">
	                    {{ __('Registrarme') }}
	                </a>
								</div>
								<div class="text-center" style="margin-bottom: 10px;">
									<a href="{{ route('password.request') }}" style="color: #019345;">
	                    {{ __('¿Olvidaste tu contraseña?') }}
	                </a>
								</div>

								<div class="footer text-center">
									<button type="submit" class="btn btn-simple btn-primary btn-lg" style="color: #FFFEFE;background-color: #019345;">
										Iniciar sesión
									</button>
								</div>



							</form>
						</div>
					</div>
				</div>
			</div>

			@include('includes.footer')

</div>
@endsection
