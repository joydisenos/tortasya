@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Registrar Direcciones')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

				<div class="row mb-4">
					<div class="col text-right">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#agregar_direccion">
						  Agregar Dirección
						</button>
					</div>
				</div>


				<div class="table-responsive">
					<table class="table">
						<thead>
							<th>Dirección</th>
							<th>Ciudad</th>
						</thead>
						<tbody>
							@foreach(Auth::user()->direcciones as $direccion)
							<tr>
								<td>{{ $direccion->direccion }}</td>
								<td>{{ $direccion->ciudad }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
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
				        		<input type="text" name="direccion" placeholder="Dirección" class="form-control">
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
			
		</div>
	</div>
</div>
@endsection