@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Mis Datos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">


				<form action="{{ route('negocio.actualizar.datos') }}" method="post" enctype="multipart/form-data">
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
							<p>Nombre</p>
						</div>
						<div class="col">
							<h6>{{ title_case(Auth::user()->nombre) }} {{ title_case(Auth::user()->apellido) }}</h6>
						</div>
					</div>

					<div class="row mb-4 justify-content-end">
						<div class="col-md-8">
							<a href="#">
								Deseas destacar tu negocio por 30 días?
								Tu negocio aparecerá en las primeras posiciones de tu localidad! Destacar por $90
							</a>
						</div>
					</div>


					<div class="row mb-4">
						<div class="col-md-4">
							<p>Foto de Perfil</p>
						</div>
						<div class="col">
							<input type="file" name="foto_perfil" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Cambiar Contraseña</p>
						</div>
						<div class="col">
							<input type="password" name="password" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Confirme su Contraseña</p>
						</div>
						<div class="col">
							<input type="password" name="password_confirmation" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col"><h6>
							Datos del Negocio
						</h6></div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Nombre del Negocio</p>
						</div>
						<div class="col">
							<input type="text" name="nombre_negocio" value="{{ Auth::user()->nombre_negocio }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Dirección</p>
						</div>
						<div class="col">
							<input type="text" name="direccion_negocio" value="{{ Auth::user()->direccion }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Breve descripción</p>
						</div>
						<div class="col">
							<textarea name="descripcion_negocio" id="" class="form-control" cols="30" rows="10">{{ Auth::user()->negocio->descripcion }}</textarea>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Foto del Negocio</p>
						</div>
						<div class="col">
							<input type="file" name="foto_negocio" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col">
							<h6>Preferencias</h6>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							  
						        <div class="form-check mb-2 mr-sm-2">
								    <input class="form-check-input" type="checkbox" name="delivery" id="delivery">
								    <label class="form-check-label" for="delivery">
								      Realiza delivery
								    </label>
								  </div>
						     
						</div>

						<div class="col-md-4">
			
						        <div class="form-check mb-2 mr-sm-2">
								    <input class="form-check-input" type="checkbox" name="pago_entrega" id="pago_entrega">
								    <label class="form-check-label" for="pago_entrega">
								      Pago contra entrega
								    </label>
								  </div>
						      
						</div>

						<div class="col-md-4">
							 
						        <div class="form-check mb-2 mr-sm-2">
								    <input class="form-check-input" type="checkbox"  name="pago_electronico" id="pago_electronico">
								    <label class="form-check-label" for="pago_electronico">
								      Pago electrónico
								    </label>
								  </div>
						      
						</div>
					</div>


				</form>
			
			
		</div>
	</div>
</div>
@endsection