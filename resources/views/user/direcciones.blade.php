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
									<th>Alias</th>
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
										<td>{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->alias : '' }}</td>
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


<!-- Modal -->
				<div class="modal fade" id="agregar_direccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header background-primary">
				        <h6 class="modal-title text-white" id="exampleModalLongTitle">Agregar Dirección</h6>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">

				      	<form action="{{ route('usuario.agregar.direccion') }}" method="post">
				      		@csrf

				      	<div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="alias" placeholder="Alias" class="form-control">
				        	</div>
				        </div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<!--<select name="ciudad" class="form-control">
				        			<option value="">Seleccione su ciudad</option>
				        		</select>-->
				        		<input type="text" name="ciudad" placeholder="Ciudad" class="form-control">
				        	</div>
				        </div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<!--<select name="ciudad" class="form-control">
				        			<option value="">Seleccione su ciudad</option>
				        		</select>-->
				        		<input type="text" name="comuna" placeholder="Comuna" class="form-control">
				        	</div>
				        </div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="calle" placeholder="Calle" class="form-control">
				        	</div>
				        </div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="numero" placeholder="Número" class="form-control">
				        	</div>
				        </div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="departamento" placeholder="Departamento" class="form-control">
				        	</div>
				        </div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="referencia" placeholder="Referencia" class="form-control">
				        	</div>
				        </div>

				        <!--<div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="direccion" placeholder="Dirección" class="form-control">
				        	</div>
				        </div>-->

				        

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<button class="btn btn-danger btn-block">
				        			Agregar
				        		</button>
				        	</div>
				        </div>

				        </form>

				      </div>
				     
				    </div>
				  </div>
				</div>
@endsection