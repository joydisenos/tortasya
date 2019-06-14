@extends('master.front')

@section('header')
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
		background-color: #C01829 !important;
	}
	.logo-tienda{
		max-width: 50px;
		margin-bottom: 8px;
	}
	.contenedor-carrito{
		max-width: 150px;
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
					    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#comentarios" role="tab" aria-controls="pills-contact" aria-selected="false">Comentarios</a>
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
								<select name="sabor" class="form-control mb-4">
									@foreach($destacado->sabores() as $sabor)
										<option value="{{ $sabor }}">{{ $sabor }}</option>
									@endforeach
								</select>
							@endif
							<h6>${{ number_format($destacado->precio) }}</h6>
							
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

						
							<div class="col-md-6 mb-4">
									<form action="{{ route('agregar.carrito' , $destacado->id) }}" method="get">
								<div class="row">
										@csrf
									<div class="col">
										<h6>{{ title_case($producto->nombre) }}</h6>
										<p>{{ $producto->descripcion }}</p>
										
										
												
													@if($producto->sabores != null)
														<select name="sabor" class="form-control mb-4">
															@foreach($producto->sabores() as $sabor)
																<option value="{{ $sabor }}">{{ $sabor }}</option>
															@endforeach
														</select>
													@endif
										<h6>${{ number_format($producto->precio) }}</h6>
												
										
										
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
					  		</div>
					  	</div>

					  	<div class="row mb-4">
					  		<div class="col">
					  			<h5>Horario</h5>
					  		</div>
					  	</div>

					  	<div class="row">
					  		<div class="col">Lunes</div>
					  		<div class="col">{{ $horario->Mon[0] == null ? 'Cerrado' : $horario->Mon[0] }}</div>
					  		<div class="col">{{ $horario->Mon[1] == null ? 'Cerrado' : $horario->Mon[1] }}</div>
					  	</div>

					  	<div class="row">
					  		<div class="col">Martes</div>
					  		<div class="col">{{ $horario->Tue[0] == null ? 'Cerrado' : $horario->Tue[0] }}</div>
					  		<div class="col">{{ $horario->Tue[1] == null ? 'Cerrado' : $horario->Tue[1] }}</div>
					  	</div>

					  	<div class="row">
					  		<div class="col">Miercoles</div>
					  		<div class="col">{{ $horario->Wed[0] == null ? 'Cerrado' : $horario->Wed[0] }}</div>
					  		<div class="col">{{ $horario->Wed[1] == null ? 'Cerrado' : $horario->Wed[1] }}</div>
					  	</div>

					  	<div class="row">
					  		<div class="col">Jueves</div>
					  		<div class="col">{{ $horario->Thu[0] == null ? 'Cerrado' : $horario->Thu[0] }}</div>
					  		<div class="col">{{ $horario->Thu[1] == null ? 'Cerrado' : $horario->Thu[1] }}</div>
					  	</div>

					  	<div class="row">
					  		<div class="col">Viernes</div>
					  		<div class="col">{{ $horario->Fri[0] == null ? 'Cerrado' : $horario->Fri[0] }}</div>
					  		<div class="col">{{ $horario->Fri[1] == null ? 'Cerrado' : $horario->Fri[1] }}</div>
					  	</div>

					  	<div class="row">
					  		<div class="col">Sábado</div>
					  		<div class="col">{{ $horario->Sat[0] == null ? 'Cerrado' : $horario->Sat[0] }}</div>
					  		<div class="col">{{ $horario->Sat[1] == null ? 'Cerrado' : $horario->Sat[1] }}</div>
					  	</div>

					  	<div class="row">
					  		<div class="col">Domingo</div>
					  		<div class="col">{{ $horario->Sun[0] == null ? 'Cerrado' : $horario->Sun[0] }}</div>
					  		<div class="col">{{ $horario->Sun[1] == null ? 'Cerrado' : $horario->Sun[1] }}</div>
					  	</div>
					  </div>
					  <div class="tab-pane fade" id="comentarios" role="tabpanel" aria-labelledby="pills-contact-tab">
					  	@if($tienda->comentarios->count() == 0)
					  		<div class="row">
					  			<div class="col">
					  				<h5>Este negocio aún no tiene comentarios</h5>
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
					  				<p>{{ title_case($comentario->user->nombre) }}</p>
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
							<h6 class="mb-4">Mi Pedido <span class="badge badge-danger">{{ Cart::count() > 0 ? ' '.Cart::count() : ''}}</span></h6>
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
									</div>
									<hr>

									@foreach($carrito as $carro)
									<div class="row mb-4 text-left">
										<div class="col-2">{{ $carro->qty }}</div>
										<div class="col">{{ $carro->name }} {{ $carro->options->sabor }}</div>
										<div class="col">${{ $total += $carro->price * $carro->qty }}</div>
									</div>
									<hr>
									@endforeach

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										<div class="col"><strong>${{ $total }}</strong></div>
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
@endsection