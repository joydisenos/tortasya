@extends('master.front')

@section('header')
<link href='https://api.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.css' rel='stylesheet' />
<style>
	.fotos{
		height: 200px;
		width: 100%;
	}
	.card{
		position: relative;
		transition: all ease .5s;
	}
	.card:hover{
		box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
		transform: translateY(-5px);
	}
	.floating{
		position: absolute;
		bottom: 10px;
		right: 10px;
	}
	.nav-pills .nav-link.active, .show>.nav-pills .nav-link{
		background-color: #ffffff !important;
		color: #C01829 !important;
		border-bottom: solid medium #C01829 !important;
		border-radius: 0;
	}
	.logo-tienda{
		max-width: 50px;
		margin-bottom: 8px;
	}
	.contenedor-carrito{
		max-width: 150px;
	}
	.btn-carrito{
		position: fixed;
		bottom: 10px;
		left: 10px;
	}
	.pagos{
		background: #ffffff;
		border-radius: 10px;
		box-shadow: 4px 4px 10px rgba(0,0,0,0.6);
		position: fixed;
		top: 160px;
		left: 300px;
		padding: 20px;
		z-index: 999;
		display: none;
	}
	#mapid { height: 250px; width: 100%;}
	.mini-foto{
		width: 100%;
		height: 60px;
	}
	.producto-card{
		transition: all ease .5s;
		border-bottom: solid medium #ffffff;
	}
	.producto-card:hover{
		border-bottom: solid medium #C01829;
		transform: translateY(-4px);
	}
	@if($tienda->negocio != null && $tienda->negocio->foto_local != null )
	.header-panel{
		background-image: url('{{ asset( 'storage/archivos/'. $tienda->id . '/' . $tienda->negocio->foto_local) }}') !important;
		background-position: center center;
		background-size: cover;
	}
	@endif

</style>
@endsection

@section('content')

@component('components.headertienda')
	@slot('logo')
		@if($tienda->negocio != null && $tienda->negocio->logo_local != null)
		 <img src="{{ asset( 'storage/archivos/'. $tienda->id . '/' . $tienda->negocio->logo_local) }}" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $tienda->nombre_negocio }}">
		@else
		 <img src="{{ asset('images/cake.jpg') }}" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $tienda->nombre_negocio }}">
		@endif
	@endslot
    @slot('titulo' , title_case($tienda->nombre_negocio))
    @slot('tienda' , $tienda)
    @slot('puntos')
    	<small><i class="fa fa-star text-warning"></i> {{ number_format($tienda->puntaje($tienda->id) , 1) }}</small> 
    @endslot
@endcomponent

<div class="container">
	<div class="row">
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="row mb-4">
				<div class="col">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#menu" role="tab" aria-controls="pills-home" aria-selected="true">Menu</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#informacion" role="tab" aria-controls="pills-profile" aria-selected="false">Información</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#comentarios" role="tab" aria-controls="pills-contact" aria-selected="false">Opiniones</a>
					  </li>
					</ul>
				</div>
			</div>

			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="menu" role="tabpanel" aria-labelledby="pills-home-tab">
				
				@if($destacados->count() > 0)
				<div class="row">
					<div class="col">
						<h4><i class="fa fa-star text-warning"></i> Recomendados</h4>
						<hr>
					</div>
				</div>
				@endif

				<div class="row mb-4 d-flex align-items-stretch">
					@foreach($destacados as $destacado)
					<div class="col-md-4 mb-4">
						<div class="card" style="height: 100%;">
						  <div class="fotos" style="background: url('{{ asset('storage/archivos/' . $tienda->id . '/' . $destacado->foto) }}') center center; background-size: cover;"></div>
						  <div class="card-body">
						    <h6>{{ title_case($destacado->nombre) }}</h6>
							<p>{{ $destacado->descripcion }}</p>
							<form action="{{ route('agregar.carrito' , $destacado->id) }}" method="get">
								@csrf
								@if($destacado->sabores != null)
								<!--<select name="sabor" class="form-control mb-4">
									@foreach($destacado->sabores() as $sabor)
										<option value="{{ $sabor }}">{{ $sabor }}</option>
									@endforeach
								</select>-->
								<p>{{ $destacado->sabores }}</p>
							@endif
								<div class="row align-items-center mb-4">
									<div class="col-6">
										<p>Cantidad:</p>
									</div>
									<div class="col-6">
										<input type="number" name="cantidad" value="1" min="1" class="form-control">
									</div>
								</div>
							
							<h6>${{ number_format($destacado->precio , 0  , ',' , '.') }}</h6>
							
								<button type="submit" class="btn btn-danger rounded-circle btn-small floating">
									<i class="fa fa-plus"></i>
								</button>
							</form>
						  </div>
						</div>
					</div>
					@endforeach
				</div>

					@if($productos->count() > 0)
					<div class="row">
						<div class="col">
							<h4>Productos</h4>
							<hr>
						</div>
					</div>
					@endif

					<div class="row mb-4">

					@foreach($productos as $producto)

						
							<div class="col-md-6 mb-4 producto-card">
									<form action="{{ route('agregar.carrito' , $producto->id) }}" method="get">
								<div class="row">
										@csrf
									<div class="col">
										<div class="mini-foto" 
										@if($producto->foto != null)

											style="background: url('{{ asset('storage/archivos/' . $tienda->id . '/' . $producto->foto) }}') center center; background-size: cover;"

										@else

											style="background: url('{{ asset('images/cake.jpg') }}') center center; background-size: cover;"

										@endif
										></div>
										<h6>{{ title_case($producto->nombre) }}</h6>
										<p>{{ $producto->descripcion }}</p>
										@if($producto->sabores != null)
														<!--<select name="sabor" class="form-control mb-4">
															@foreach($producto->sabores() as $sabor)
																<option value="{{ $sabor }}">{{ $sabor }}</option>
															@endforeach
														</select>-->
														<p>{{ $producto->sabores }}</p>
													@endif
										
								<div class="row align-items-center">
									<div class="col-6">
										<p>Cantidad:</p>
									</div>
									<div class="col-6">
										<input type="number" name="cantidad" value="1" min="1" class="form-control">
									</div>
								</div>
												

										<h6>${{ number_format($producto->precio , 0  , ',' , '.') }}</h6>
												
										
										
									</div>

									<div class="col-3">
										<button class="btn btn-danger rounded-circle btn-small">
											<i class="fa fa-plus"></i>
										</button>
									</div>
								</div>
								</form>
							</div>
						

					@endforeach

					</div>
					  </div>
					  <div class="tab-pane fade" id="informacion" role="tabpanel" aria-labelledby="pills-profile-tab">

					  	<div class="row mb-4">
					  		<div class="col">
					  			<p>{{ $tienda->negocio != null ? $tienda->negocio->descripcion : '' }}</p>
					  			<p><strong>Dirección:</strong> {{ $tienda->direccion }}</p>
					  		</div>
					  	</div>

					  	@if($tienda->latitud != null && $tienda->longitud != null)
					  	<!--<div id="mapid"></div>-->
					  	<div id='map' style='width: 100%; height: 300px;'></div>
					  	@endif
						
						@if($horario != null)
					  	<div class="row mb-4 mt-4">
					  		<div class="col">
					  			<h5>Horarios</h5>
					  		</div>
					  	</div>

					  	<div class="row">
					  		<div class="col">Lunes</div>
					  		<div class="col">{{ $horario->Mon[0] == null ? 'Cerrado' : $horario->Mon[0] }}</div>
					  		<div class="col">{{ $horario->Mon[1] == null ? 'Cerrado' : $horario->Mon[1] }}</div>
					  	</div>
					  	<hr>

					  	<div class="row">
					  		<div class="col">Martes</div>
					  		<div class="col">{{ $horario->Tue[0] == null ? 'Cerrado' : $horario->Tue[0] }}</div>
					  		<div class="col">{{ $horario->Tue[1] == null ? 'Cerrado' : $horario->Tue[1] }}</div>
					  	</div>
					  	<hr>

					  	<div class="row">
					  		<div class="col">Miercoles</div>
					  		<div class="col">{{ $horario->Wed[0] == null ? 'Cerrado' : $horario->Wed[0] }}</div>
					  		<div class="col">{{ $horario->Wed[1] == null ? 'Cerrado' : $horario->Wed[1] }}</div>
					  	</div>
					  	<hr>

					  	<div class="row">
					  		<div class="col">Jueves</div>
					  		<div class="col">{{ $horario->Thu[0] == null ? 'Cerrado' : $horario->Thu[0] }}</div>
					  		<div class="col">{{ $horario->Thu[1] == null ? 'Cerrado' : $horario->Thu[1] }}</div>
					  	</div>
					  	<hr>

					  	<div class="row">
					  		<div class="col">Viernes</div>
					  		<div class="col">{{ $horario->Fri[0] == null ? 'Cerrado' : $horario->Fri[0] }}</div>
					  		<div class="col">{{ $horario->Fri[1] == null ? 'Cerrado' : $horario->Fri[1] }}</div>
					  	</div>
					  	<hr>

					  	<div class="row">
					  		<div class="col">Sábado</div>
					  		<div class="col">{{ $horario->Sat[0] == null ? 'Cerrado' : $horario->Sat[0] }}</div>
					  		<div class="col">{{ $horario->Sat[1] == null ? 'Cerrado' : $horario->Sat[1] }}</div>
					  	</div>
					  	<hr>

					  	<div class="row">
					  		<div class="col">Domingo</div>
					  		<div class="col">{{ $horario->Sun[0] == null ? 'Cerrado' : $horario->Sun[0] }}</div>
					  		<div class="col">{{ $horario->Sun[1] == null ? 'Cerrado' : $horario->Sun[1] }}</div>
					  	</div>
					  	<hr>
					  	@endif

					  </div>
					  <div class="tab-pane fade" id="comentarios" role="tabpanel" aria-labelledby="pills-contact-tab">
					  	@if($tienda->comentarios->count() == 0)
					  		<div class="row">
					  			<div class="col">
					  				<h5>Este negocio aún no tiene opiniones</h5>
					  			</div>
					  		</div>
					  	@else
					  		<div class="row mt-4 mb-4">
					  			<div class="col d-flex align-items-center">
					  				<h6 class="background-primary text-white d-inline p-2 rounded"><i class="fa fa-star text-warning"></i> {{ number_format($tienda->puntaje($tienda->id) , 1) }}</h6>
					  			</div>
					  			<div class="col">
					  				<canvas id="myChart"></canvas>
					  			</div>
					  		</div>
					  	@endif

					  	@foreach($tienda->comentarios as $comentario)
					  		<div class="row mb-4">
					  			<div class="col-2">
					  				<img src="{{ $comentario->user->foto_perfil == null ? asset('images/perfil.png') : asset('storage/archivos/' . $comentario->user->id . '/' . $comentario->user->foto_perfil) }}" alt="" class="img-fluid rounded-circle">
					  			</div>
					  			<div class="col-8 d-flex align-items-center">
					  				<p>"{{ $comentario->comentario }}"</p>
					  			</div>
					  			<div class="col-2 d-flex align-items-center">
					  				@if($comentario->puntos == 1)
					  				<i class="fa fa-star text-warning"></i>
					  				@elseif($comentario->puntos == 2)
					  				<i class="fa fa-star text-warning"></i>
					  				<i class="fa fa-star text-warning"></i>
					  				@elseif($comentario->puntos == 3)
					  				<i class="fa fa-star text-warning"></i>
					  				<i class="fa fa-star text-warning"></i>
					  				<i class="fa fa-star text-warning"></i>
					  				@elseif($comentario->puntos == 4)
					  				<i class="fa fa-star text-warning"></i>
					  				<i class="fa fa-star text-warning"></i>
					  				<i class="fa fa-star text-warning"></i>
					  				<i class="fa fa-star text-warning"></i>
					  				@elseif($comentario->puntos == 5)
					  				<i class="fa fa-star text-warning"></i>
					  				<i class="fa fa-star text-warning"></i>
					  				<i class="fa fa-star text-warning"></i>
					  				<i class="fa fa-star text-warning"></i>
					  				<i class="fa fa-star text-warning"></i>
					  				@endif
					  			</div>

					  			<div class="col-12 text-center">
					  				<p>{{ title_case($comentario->user->nombre) }} {{ title_case($comentario->user->apellido) }}</p>
					  			</div>
					  		</div>

					  		<hr>
					  	@endforeach
					  </div>
			</div>

					
					
				</div>

				<div class="col-4 pt-4 pb-4 mt-4 mb-4 d-none d-lg-block">
					<div class="row">
						<div class="col text-center border p-4">
							<h6 class="mb-4">Mi Pedido <span class="badge badge-danger">{{ $carrito->count() > 0 ? ' '. $carrito->count() : ''}}</span></h6>
									@if($carrito->count() == 0)
								<div class="contenedor-carrito mx-auto">
									<img src="{{ asset('images/icon-cake.png') }}" class="img-fluid img-carrito mb-4" alt="">
								</div>
							<p class="mb-4">Aún no tienes pedidos</p>
									@else
									<div class="row mb-4 text-left">
										<div class="col-2"><strong>Cant.</strong></div>
										<div class="col"><strong>Nombre</strong></div>
										<div class="col"><strong>Precio</strong></div>
										<div class="col"></div>
									</div>
									<hr>

									@foreach($carrito as $carro)
									<div class="row mb-4 text-left">
										<div class="col-2">{{ $carro->qty }}</div>
										<div class="col">{{ $carro->name }} {{ $carro->options->sabor }}</div>
										<div class="col">${{ number_format($total += $carro->price * $carro->qty , 0  , ',' , '.') }}</div>
										<div class="col"><a href="{{ route('eliminar.carrito' , $carro->rowId) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></div>
									</div>
									<hr>
									@endforeach

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										<div class="col"><strong>${{ number_format($total , 0  , ',' , '.') }}</strong></div>
									</div>

									<div class="row">
										<div class="col text-center">
											<a href="{{ route('ordenar' , [$tienda->slug]) }}" class="btn btn-danger">Ordenar</a>
										</div>
									</div>

									@endif
						</div>
					</div>
				</div>
	</div>
</div>

<button class="btn btn-danger btn-carrito d-lg-none" data-toggle="modal" data-target="#carrito-mobile"><i class="fa fa-shopping-cart"></i> {{ $carrito->count() > 0 ? ' '. $carrito->count() : ''}}</button>

 <div class="modal fade" id="carrito-mobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document"> 
            <div class="modal-content">
              <div class="modal-header">
              
              	<h6 class="modal-title" id="exampleModalLongTitle">Mi Pedido <span class="badge badge-danger">{{ $carrito->count() > 0 ? ' '. $carrito->count() : ''}}</span></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">

              	<div class="row">
						<div class="col text-center p-4">
							
									@if($carrito->count() == 0)
								<div class="contenedor-carrito mx-auto">
									<img src="{{ asset('images/icon-cake.png') }}" class="img-fluid img-carrito mb-4" alt="">
								</div>
							<p class="mb-4">Aún no tienes pedidos</p>
									@else
									<div class="row mb-4 text-left">
										<div class="col-2"><strong>Cant.</strong></div>
										<div class="col"><strong>Nombre</strong></div>
										<div class="col"><strong>Precio</strong></div>
										<div class="col"></div>
									</div>
									<hr>

									@foreach($carrito as $carro)
									<div class="row mb-4 text-left">
										<div class="col-2">{{ $carro->qty }}</div>
										<div class="col">{{ $carro->name }} {{ $carro->options->sabor }}</div>
										<div class="col">${{ number_format($totalMobile += $carro->price * $carro->qty , 0  , ',' , '.') }}</div>
										<div class="col"><a href="{{ route('eliminar.carrito' , $carro->rowId) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></div>
									</div>
									<hr>
									@endforeach

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										<div class="col"><strong>${{ number_format($totalMobile , 0  , ',' , '.') }}</strong></div>
									</div>

									<div class="row">
										<div class="col text-center">
											<a href="{{ route('ordenar' , [$tienda->slug]) }}" class="btn btn-danger">Ordenar</a>
										</div>
									</div>

									@endif
						</div>
					</div>

              </div>
            </div>
          </div>
        </div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.js'></script>
<script>

	$('.medios-pago').click(function(){
		$('.pagos').toggle({
			duration: 500,
			easing: 'swing'
		});
	});

	$('.medios-pago').mouseleave(function(){
		$('.pagos').hide('slow');
	});

	
	var ctx = document.getElementById('myChart').getContext('2d');
	var datos = [{{ $comentariosEstadisticas }}];
	var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'horizontalBar',

    // The data for our dataset
    data: {
        labels: ['Excelente', 'Muy Bueno', 'Bueno', 'Regular', 'Malo'],
        datasets: [{
            label: 'Opiniones',
            backgroundColor: '#C01829',
            borderColor: 'rgb(255, 99, 132)',
            data: datos
        }]
    },

    // Configuration options go here
    options: {
    	legend: {
            display: false
        }
    }
});
	lat = '{{ $tienda->latitud }}';
	long = '{{ $tienda->longitud }}';

	mapboxgl.accessToken = 'pk.eyJ1Ijoiam95ZGlzZW5vcyIsImEiOiJjanhsNjl1OHMwMnVoM3hxZWtjamJxeGpoIn0.fsWaR9XzZr2IcBCNZCzQ6A';

	var map2 = new mapboxgl.Map({
	container: 'map', // container id
	style: 'mapbox://styles/mapbox/streets-v11',
	center: [long, lat], // starting position
	zoom: 9 // starting zoom
	});

	new mapboxgl.Marker()
		.setLngLat([long, lat])
		.addTo(map2);

	/*var map = L.map('mapid', {
    center: [lat , long],
    zoom: 13
});

	var map = L.map('mapid').setView([lat , long], 13);

	L.tileLayer('https://api.tiles.mapbox.com/v4/mapbox.streets/18/1/1.mvt?access_token=sk.eyJ1Ijoiam95ZGlzZW5vcyIsImEiOiJjanhsNmc5emEwMnhuM3hvYTF5ajBpOXFpIn0.NuVHktr-KvGLpVybs480tA', {
		    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		    maxZoom: 18,
		    id: 'mapbox.streets',
		    accessToken: 'sk.eyJ1Ijoiam95ZGlzZW5vcyIsImEiOiJjanhsNmc5emEwMnhuM3hvYTF5ajBpOXFpIn0.NuVHktr-KvGLpVybs480tA'
		}).addTo(map);

	L.marker([lat , long]).addTo(map)
	    .bindPopup('{{ $tienda->nombre_negocio }}')
	    .openPopup();*/

	
</script>
@endsection