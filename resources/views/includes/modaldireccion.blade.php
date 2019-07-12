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

				      	<!--<div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<input type="text" name="alias" placeholder="Alias" class="form-control">
				        	</div>
				        </div>-->
				        <input type="hidden" name="alias" value="nulo">

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		
				        		<select name="ciudad" class="form-control select-ciudad" required>
                                            
                                    @foreach(App\Region::regiones() as $key => $region)
                                        <option value="{{ $key }}" data-regiones="{{ json_encode($region) }}" {{ $key == "Metropolitana de Santiago"? 'selected' : '' }}>{{ $key }}</option>
                                    @endforeach
                                   
                                </select>
				        	</div>
				        </div>

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		
				        		<select name="comuna" class="form-control select-region" required>
                                            @foreach( App\Region::regiones()['Metropolitana de Santiago'] as $region )
                                           <option value="{{ str_slug($region) }}">{{ $region }}</option>
                                           @endforeach
                                            
                                            
                                           
                                        </select>
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