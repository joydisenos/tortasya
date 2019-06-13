@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Ventas')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Orden</th>
						<th>Usuario</th>
						<th>Productos</th>
						<th>Envío</th>
						<th>Pago</th>
						<th>Estatus</th>
					</thead>
					<tbody>
						@foreach($ventas as $venta)
						<tr>
							<td>{{ $venta->id }}</td>
							<td>{{ $venta->user->nombre }}</td>
							<td>{{ $venta->productos->count() }}</td>
							<td>{{ $venta->envio }}</td>
							<td>{{ $venta->pago }}</td>
							<td>{{ $venta->verEstatus($venta->estatus) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
			
		</div>
	</div>
</div>
@endsection