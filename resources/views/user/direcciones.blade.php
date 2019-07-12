@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Mis Direcciones')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col-md-9 pt-4 pb-4 mt-4 mb-4">


				<div class="row mb-4">
					<div class="col text-right">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#agregar_direccion">
						  Agregar Dirección
						</button>
					</div>
				</div>
				
				<div class="row">
					<div class="col">
						@if($direcciones->count() > 0)
						<div class="table-responsive" style="width: 100% ; overflow-x: scroll;">
							<table class="table">
								<thead>
									<!--<th>Alias</th>-->
									<th>Ciudad</th>
									<th>Comuna</th>
									<th>Calle</th>
									<th>Número</th>
									<th>Departamento</th>
									<th>Referencia</th>
									<th></th>
									<th></th>
								</thead>
								<tbody>
									@foreach($direcciones as $direccion)
									<tr>
										<!--<td>{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->alias : '' }}</td>-->
										<td>{{ $direccion->ciudad }}</td>
										<td>{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->comuna : '' }}</td>
										<td>{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->calle : '' }}</td>
										<td>{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->numero : '' }}</td>
										<td>{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->departamento : '' }}</td>
										<td>{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->referencia : '' }}</td>
										<td><a href="{{ route('usuario.editar.direccion' , $direccion->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
										<td><a href="{{ route('usuario.borrar.direccion' , $direccion->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@else
						<div class="text-center">
							<h6>¡Registra una dirección para comenzar a recibir pedidos!</h6>
						</div>
						@endif
					</div>
				</div>
					
			
		</div>
	</div>
</div>


@include('includes.modaldireccion')
@endsection