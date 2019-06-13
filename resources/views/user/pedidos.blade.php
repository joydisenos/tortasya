@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Mi Cuenta')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Orden</th>
						<th>Negocio</th>
						<th>Productos</th>
						<th>Envío</th>
						<th>Pago</th>
						<th>Estatus</th>
					</thead>
					<tbody>
						@foreach($pedidos as $pedido)
						<tr>
							<td>{{ $pedido->id }}</td>
							<td>{{ $pedido->negocio->nombre_negocio }}</td>
							<td>{{ $pedido->productos->count() }}</td>
							<td>{{ $pedido->envio }}</td>
							<td>{{ $pedido->pago }}</td>
							<td>{{ $pedido->verEstatus($pedido->estatus) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>
@endsection