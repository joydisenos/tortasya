@extends('master.front')
@section('header')
<style>
    .imagen-tienda{
        height: 200px;
        background-size: cover;
        background-position: center center;
    }
    .fondo{
    	width: 100%;
    	height: 100%;
    	background: rgba(0,0,0,0.5);
    }
</style>
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Favoritos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4 align-items-center d-flex justify-content-center">

			<div class="row">
				<div class="col text-center">
					
						<h3 class="color-primary mb-4">Bienvenid@, {{ title_case(Auth::user()->nombre) }} {{ title_case(Auth::user()->apellido) }}</h3>
						 	<p class="mb-4">Estás registrado como @role('admin') Administrador @else @role('negocio') Local, Negocio y/o Emprendedor @else Usuario @endrole @endrole</p>
						@role('negocio')

						<div class="row">
							@foreach(Auth::user()->productos as $producto)
								<div class="col-md-4 mb-4">
									<a href="{{ route('negocio.modificar.producto' , [$producto->id]) }}">
									<div class="card" style="height: 100%;">
									  <div class="card-body p-0" style="background: url('{{ asset('storage/archivos/' . Auth::user()->id . '/' . $producto->foto) }}') center center; background-size: cover;">
									    <div class="fondo p-3">
									    	<h6 class="text-white"><strong>{{ title_case($producto->nombre) }}</strong></h6>
											<p class="text-white">{{ str_limit($producto->descripcion , 30) }}</p>
									    </div>
									  </div>
									</div>
									</a>
								</div>
							@endforeach
						</div>
						
						@else
						<h6 class="mb-4">Explora todas las delicias en tu ciudad y podrás solicitar ahora mismo un pedido!</h6>
						<a href="{{ route('home') }}" class="btn btn-danger">Comenzar</a>
						@endrole
						
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection