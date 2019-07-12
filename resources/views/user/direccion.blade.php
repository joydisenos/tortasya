@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Mis Direcciones')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col-md-9 pt-4 pb-4 mt-4 mb-4">

				<form action="{{ route('usuario.actualizar.direccion' , $direccion->id) }}" method="post">

				<div class="row mb-4">
					<div class="col text-right">
						<button type="submit" class="btn btn-danger">
						  Actualizar
						</button>
					</div>
				</div>
				
				      		@csrf

				      	<input type="hidden" name="alias" value="nulo">

				        

						<div class="modal-body p-0 m-0">

					        <div class="row justify-content-center mb-3">
					        	<div class="col-10">
					        		<!--<select name="ciudad" class="form-control">
					        			<option value="">Seleccione su ciudad</option>
					        		</select>-->

					        		<select name="ciudad" class="form-control select-ciudad" required>
                                            
                                    @foreach(App\Region::regiones() as $key => $region)
                                        <option value="{{ $key }}" data-regiones="{{ json_encode($region) }}" {{ $key == $direccion->ciudad ? 'selected' : '' }}>{{ $key }}</option>
                                    @endforeach
                                   
                                </select>
					        	</div>
					        </div>

					        <div class="row justify-content-center mb-3">
					        	<div class="col-10">
					        		<!--<select name="ciudad" class="form-control">
					        			<option value="">Seleccione su ciudad</option>
					        		</select>-->
					        		

					        		<select name="comuna" class="form-control select-region" required>

                                            
                                            
                                           
                                        </select>
					        	</div>
					        </div>

				    	</div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="calle" placeholder="Calle" class="form-control" value="{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->calle : '' }}">
				        	</div>
				        </div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="numero" placeholder="Número" class="form-control" value="{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->numero : '' }}">
				        	</div>
				        </div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="departamento" placeholder="Departamento" class="form-control" value="{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->departamento : '' }}">
				        	</div>
				        </div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="referencia" placeholder="Referencia" class="form-control" value="{{ json_decode($direccion->direccion) != null ? json_decode($direccion->direccion)->referencia : '' }}">
				        	</div>
				        </div>

				        </form>
					
			
		</div>
	</div>
</div>
@endsection