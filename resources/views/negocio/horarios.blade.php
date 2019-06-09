@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Horarios y envíos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">


				<form action="{{ route('negocio.actualizar.horario') }}" method="post">
					@csrf

					<div class="row mb-4">
						<div class="col text-right">
							<button type="submit" class="btn btn-danger">
								Actualizar
							</button>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<h6>Lunes</h6>
						</div>
						<div class="col">
							<input type="time" name="d_lunes" value="{{ $horario != null ? $horario->Mon[0] : '' }}" class="form-control" name="">
						</div>
						<div class="col">
							<input type="time" name="h_lunes" value="{{ $horario != null ? $horario->Mon[1] : '' }}" class="form-control" name="">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<h6>Martes</h6>
						</div>
						<div class="col">
							<input type="time" name="d_martes" value="{{ $horario != null ? $horario->Tue[0] : '' }}" class="form-control" name="">
						</div>
						<div class="col">
							<input type="time" name="h_martes" value="{{ $horario != null ? $horario->Tue[1] : '' }}" class="form-control" name="">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<h6>Miercoles</h6>
						</div>
						<div class="col">
							<input type="time" name="d_miercoles" value="{{ $horario != null ? $horario->Wed[0] : '' }}" class="form-control" name="">
						</div>
						<div class="col">
							<input type="time" name="h_miercoles" value="{{ $horario != null ? $horario->Wed[1] : '' }}" class="form-control" name="">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<h6>Jueves</h6>
						</div>
						<div class="col">
							<input type="time" name="d_jueves" value="{{ $horario != null ? $horario->Thu[0] : '' }}" class="form-control" name="">
						</div>
						<div class="col">
							<input type="time" name="h_jueves" value="{{ $horario != null ? $horario->Thu[1] : '' }}" class="form-control" name="">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<h6>Viernes</h6>
						</div>
						<div class="col">
							<input type="time" name="d_viernes" value="{{ $horario != null ? $horario->Fri[0] : '' }}" class="form-control" name="">
						</div>
						<div class="col">
							<input type="time" name="h_viernes" value="{{ $horario != null ? $horario->Fri[1] : '' }}" class="form-control" name="">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<h6>Sábado</h6>
						</div>
						<div class="col">
							<input type="time" name="d_sabado" value="{{ $horario != null ? $horario->Sat[0] : '' }}" class="form-control" name="">
						</div>
						<div class="col">
							<input type="time" name="h_sabado" value="{{ $horario != null ? $horario->Sat[1] : '' }}" class="form-control" name="">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<h6>Domingo</h6>
						</div>
						<div class="col">
							<input type="time" name="d_domingo" value="{{ $horario != null ? $horario->Sun[0] : '' }}" class="form-control" name="">
						</div>
						<div class="col">
							<input type="time" name="h_domingo" value="{{ $horario != null ? $horario->Sun[1] : '' }}" class="form-control" name="">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col">
							<h6>
								Formas de envío
							</h6>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Entregas a Domicilio?</p>
						</div>
						<div class="col">
							<input type="checkbox" name="entrega_domicilio" {{ $negocio->entrega_domicilio == 1 ? 'checked' : '' }}>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Se puede retirar por el local?</p>
						</div>
						<div class="col">
							<input type="checkbox" name="entrega_local" {{ $negocio->entrega_local == 1 ? 'checked' : '' }}>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col">
							<h6>
								Formas de pago
							</h6>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Tarjeta al delivery</p>
						</div>
						<div class="col">
							<input type="checkbox" name="tarjeta_delivery" {{ $negocio->tarjeta_delivery == 1 ? 'checked' : '' }}>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Envío contra entrega</p>
						</div>
						<div class="col">
							<input type="checkbox" name="envio_entrega" {{ $negocio->envio_entrega == 1 ? 'checked' : '' }}>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col">
							<h6>
								Costo de envíos
							</h6>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Envío Gratis</p>
						</div>
						<div class="col">
							<input type="checkbox" name="envio_gratis" {{ $negocio->envio_gratis == 1 ? 'checked' : '' }}>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Variable según zona</p>
						</div>
						<div class="col">
							<input type="checkbox" name="variable" {{ $negocio->variable == 1 ? 'checked' : '' }}>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Costo fijo</p>
						</div>
						<div class="col">
							<input type="checkbox" name="costo_fijo" {{ $negocio->costo_fijo == 1 ? 'checked' : '' }}>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Costo de envío</p>
						</div>
						<div class="col">
							<input type="number" class="form-control" name="costo_envio" value="{{ $negocio->costo_envio }}">
						</div>
					</div>
					
				</form>
			
			
		</div>
	</div>
</div>
@endsection