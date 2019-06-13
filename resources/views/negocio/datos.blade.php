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
								<p>Deseas destacar tu negocio por 30 días?
								Tu negocio aparecerá en las primeras posiciones de tu localidad! Destacar por $90</p>
							<a mp-mode="dftl" href="https://www.mercadopago.com/mlc/checkout/pay?pref_id=443525800-b6353ec8-a8e6-400b-84d3-887edb039b09" name="MP-payButton" class='blue-ar-l-rn-none'>Destacar</a>
							<script type="text/javascript">
							(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
							</script>
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
							<p>Logotipo del Negocio</p>
						</div>
						<div class="col">
							<input type="file" name="logo_local" class="form-control">
						</div>
					</div>

					@if(Auth::user()->negocio->logo_local != null)

					<div class="row mb-4">
						<div class="col-md-4">
							
						</div>
						<div class="col">
							<img src="{{ asset( 'storage/archivos/' . Auth::user()->id . '/' . Auth::user()->negocio->logo_local) }}" class="img-fluid" alt="">
						</div>
					</div>

					@endif

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Foto del Negocio</p>
						</div>
						<div class="col">
							<input type="file" name="foto_local" class="form-control">
						</div>
					</div>

					@if(Auth::user()->negocio->foto_local != null)

					<div class="row mb-4">
						<div class="col-md-4">
							
						</div>
						<div class="col">
							<img src="{{ asset( 'storage/archivos/' . Auth::user()->id . '/' . Auth::user()->negocio->foto_local) }}" class="img-fluid" alt="">
						</div>
					</div>

					@endif

					


				</form>
			
			
		</div>
	</div>
</div>
@endsection