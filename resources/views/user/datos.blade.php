@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Mi Perfil')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">


				<form action="{{ route('usuario.actualizar.datos') }}" method="post" enctype="multipart/form-data">
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

					


				</form>
			
		</div>
	</div>
</div>
@endsection