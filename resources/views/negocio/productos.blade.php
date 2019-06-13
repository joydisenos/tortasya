@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Productos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">


				<div class="row">
					<div class="col mb-4 text-right">
						<a href="{{ route('negocio.crear.producto') }}" class="btn btn-danger">
							Nuevo Producto
						</a>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<th>Imagen</th>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Precio</th>
									<th>Ventas</th>
									<th>Estatus</th>
									<th></th>
									<th></th>
								</thead>
								<tbody>
									@foreach($productos as $producto)
									<tr>
										<td>
											@if($producto->foto == null)
											<img src="{{ asset('images/logo-01.png') }}" style="max-width: 50px;" alt="Imagen {{ $producto->nombre }}">
											@else
											<img src="{{ asset('storage/archivos/' . Auth::user()->id . '/' . $producto->foto) }}" style="max-width: 50px;" alt="Imagen {{ $producto->nombre }}">
											@endif
										</td>
										<td>{{ title_case($producto->nombre) }}</td>
										<td>{{ str_limit($producto->descripcion , 30) }}</td>
										<td>{{ number_format($producto->precio) }}</td>
										<td></td>
										<td>{{ $producto->estatusProducto($producto->estatus) }}</td>
										<td>
											@if($producto->estatus == 1)
											<a href="{{ route('negocio.estatus.producto' , [$producto->id , 0]) }}" class="btn btn-danger">Desactivar</a>
											@else
											<a href="{{ route('negocio.estatus.producto' , [$producto->id , 1]) }}" class="btn btn-success">Activar</a>
											@endif
										</td>
										<td>
											<a href="{{ route('negocio.modificar.producto' , [$producto->id]) }}">modificar</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			
			
		</div>
	</div>
</div>
@endsection