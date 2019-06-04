@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , title_case($tienda->nombre_negocio))
@endcomponent

<div class="container">
	<div class="row">
		<div class="col pt-4 pb-4 mt-4 mb-4">

			@foreach($productos as $producto)

				<div class="row mb-4">
					<div class="col-3">
						<img src="{{ $producto->foto == null ? asset('images/logo-01.png') : asset('storage/archivos/' . $tienda->id . '/' . $producto->foto) }}" class="img-fluid" alt="Foto {{ $producto->nombre }}">
					</div>
					<div class="col">
						<h3>{{ title_case($producto->nombre) }}</h3>
						<p>{{ $producto->descripcion }}</p>
					</div>
					<div class="col-3">
						<button class="btn btn-danger btn-block">
							{{ $producto->precio }}
						</button>
					</div>
				</div>

			@endforeach
			
		</div>
	</div>
</div>
@endsection