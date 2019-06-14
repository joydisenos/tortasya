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
						<th>Marcar</th>
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
							<td>
								@if($venta->estatus == 1)
								<a href="{{ route('negocio.estatus.orden' , [$venta->id , 2]) }}" class="btn btn-success"><i class="fa fa-check"></i></a>
								<a href="{{ route('negocio.estatus.orden' , [$venta->id , 0]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
			
		</div>
	</div>
</div>
@endsection