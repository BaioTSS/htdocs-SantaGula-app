@extends('layouts.app')

@section('body-class', 'signup-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('/imagenes/fondos/log.png') }}'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="card card-signup">
							<form method="POST" action="{{ route('register') }}">
                @csrf
								<div class="header header-primary text-center" style="background: #019345;">
									<h4>Registro de usuarios</h4>

								</div>

								<div class="content">

                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">face</i>
                    </span>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre y Apellido" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
                    <input id="email" type="email" placeholder="Email" class="
                    form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
									</div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">phone</i>
										</span>
                    <input id="phone" type="phone" placeholder="Tel (ej: 3404508282 sin 0̶  y 1̶5̶)" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>
									</div>


									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
                    <input id="password" type="password" placeholder="Contraseña" class="
                    form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
									</div>

                  <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
                    <input type="password" placeholder="Confirmar contraseña" class="
                    form-control" name="password_confirmation" required autocomplete="new-password">
									</div>

								</div>
								<div class="footer text-center">
									<button type="submit" class="btn btn-simple btn-primary btn-lg">Confirmar Registro</button>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>

			@include('includes.footer')

</div>
@endsection
