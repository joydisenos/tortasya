@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Crear Producto')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<form action="{{ route('negocio.actualizar.producto' , [$producto->id]) }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row mb-4">
					<div class="col">
						@if($producto->foto == null)
						<img src="{{ asset('images/logo-01.png') }}" class="img-fluid" alt="Imagen {{ $producto->nombre }}">
						@else
						<img src="{{ asset('storage/archivos/' . Auth::user()->id . '/' . $producto->foto) }}" class="img-fluid" alt="Imagen {{ $producto->nombre }}">
						@endif
					</div>
					<div class="col">
						<input type="file" name="foto" class="form-control">
					</div>
				</div>

				<div class="row mb-4">

					<div class="col">
						<input type="text" name="nombre" value="{{ $producto->nombre }}" placeholder="Nombre" class="form-control">
					</div>

					<div class="col">
						<input type="number" step="0.01" value="{{ $producto->precio }}" name="precio" placeholder="Precio" class="form-control">
					</div>
					
				</div>

				<div class="row mb-4">
					<div class="col">
						<textarea name="descripcion" placeholder="Descripción" cols="30" rows="10" class="form-control">{{ $producto->descripcion }}</textarea>
					</div>
				</div>

				<div class="row mb-4">
					<div class="col">
						<button class="btn btn-danger">
							Crear
						</button>
					</div>
				</div>

			</form>
			
		</div>
	</div>
</div>
@endsection