@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Orden #' . $orden->id )
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">
			

				<div class="row mb-4">
					<div class="col-4">
						<p>Fecha:</p>
					</div>
					<div class="col-8">
						<p><strong>{{ $orden->created_at->format('d/m/Y h:i') }}</strong></p>
					</div>
				</div>

				<hr>

				<div class="row mb-4">
					<div class="col-4">
						<p>Estatus:</p>
					</div>
					<div class="col-8">
						<p><strong>{{ $orden->verEstatus($orden->estatus) }}</strong></p>
					</div>
				</div>

				<hr>

				<div class="row mb-4">
					<div class="col-4">
						<p>Usuario:</p>
					</div>
					<div class="col-8">
						<p><strong>{{ title_case($orden->user->nombre) }} {{ title_case($orden->user->apellido) }}</strong></p>
					</div>
				</div>

				<hr>

				<div class="row mb-4">
					<div class="col-4">
						<p>Email:</p>
					</div>
					<div class="col-8">
						<p><strong>{{ $orden->user->email }}</strong></p>
					</div>
				</div>

				<hr>

				<div class="row mb-4">
					<div class="col-4">
						<p>Teléfono:</p>
					</div>
					<div class="col-8">
						<p><strong>{{ $orden->user->telefono }}</strong> <a target="_blank" class="ml-4 btn btn-success" href="https://wa.me/{{ str_slug($orden->user->telefono) }}">Comunícate directo por Whatsapp <i class="fa fa-whatsapp"></i></a></p>
				
					</div>
				</div>

				<hr>

				<div class="row mb-4">
					<div class="col-4">
						<p>Envío:</p>
					</div>
					<div class="col-8">
						<p><strong>{{ $orden->envio }}</strong></p>
					</div>
				</div>

				<hr>

				<div class="row mb-4">
					<div class="col-4">
						<p>Pago:</p>
					</div>
					<div class="col-8">
						<p><strong>{{ $orden->pago }}</strong></p>
					</div>
				</div>

				<hr>

				@if($orden->direccion_id > 0)
				
				<div class="row mb-4">
					<div class="col-4">
						<p>Dirección:</p>
					</div>
					<div class="col-8">
						<p>Ciudad: <strong>{{ $orden->direccion->ciudad }}</strong></p>
						<p>Comuna: <strong>{{ $orden->verDireccion($orden->direccion_id)->comuna }}</strong></p>
						<p>Calle: <strong>{{ $orden->verDireccion($orden->direccion_id)->calle }}</strong></p>
						<p>Número: <strong>{{ $orden->verDireccion($orden->direccion_id)->numero }}</strong></p>
						<p>Departamento: <strong>{{ $orden->verDireccion($orden->direccion_id)->departamento }}</strong></p>
						<p>Referencia: <strong>{{ $orden->verDireccion($orden->direccion_id)->referencia }}</strong></p>
					</div>
				</div>
					
				@endif

				<div class="row mb-4">
					<div class="col">
						<div class="text-center mb-4">
							<h4>Pedido</h4>
						</div>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<th>Producto</th>
									<th></th>
									<th>Cantidad</th>
									<th>Precio</th>
								</thead>
								<tbody>
									@foreach($orden->productos as $producto)
									<tr>
										<td>
											{{ $producto->producto->nombre }}
										</td>
										<td>
											
										</td>
										<td>{{ $producto->cantidad }}</td>
										<td class="text-right">${{ number_format($producto->producto->precio * $producto->cantidad , 0  , ',' , '.') }}</td>
									</tr>
									@endforeach
									@if($orden->envio == 'Delivery')
									<tr>
										<td></td>
										<td></td>
										<td>Envío:</td>
										<td class="text-right">${{ number_format($orden->negocio->negocio->costo_envio , 0 , ',' , '.') }}</td>
									</tr>
									@endif
									<tr>
										<td></td>
										<td></td>
										<td>Total a Pagar:</td>
										<td class="text-right">${{ number_format($orden->total , 0 , ',' , '.') }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			
			
		</div>
	</div>
</div>
@endsection