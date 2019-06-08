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
    	<small><i class="fa fa-star text-warning"></i> 8.5</small> 
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
					    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Información</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Comentarios</a>
					  </li>
					</ul>
				</div>
			</div>

			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="menu" role="tabpanel" aria-labelledby="pills-home-tab">
				  	<div class="row">
					<div class="col">
						<h4><i class="fa fa-star text-warning"></i> Recomendados</h4>
						<hr>
					</div>
				</div>

				<div class="row mb-4 d-flex align-items-stretch">
					@foreach($destacados as $destacado)
					<div class="col-md-4">
						<div class="card" style="height: 100%;">
						  <div class="fotos" style="background: url('{{ asset('storage/archivos/' . $tienda->id . '/' . $destacado->foto) }}') center center; background-size: cover;"></div>
						  <div class="card-body">
						    <h6>{{ title_case($destacado->nombre) }}</h6>
							<p>{{ $destacado->descripcion }}</p>
							<h6>${{ number_format($destacado->precio) }}</h6>
								<a class="btn btn-danger rounded-circle btn-small floating" href="{{ route('agregar.carrito' , $destacado->id) }}">
									<i class="fa fa-plus"></i>
								</a>
						  </div>
						</div>
					</div>
					@endforeach
				</div>

					<div class="row">
						<div class="col">
							<h4>Productos</h4>
							<hr>
						</div>
					</div>

					<div class="row mb-4">

					@foreach($productos as $producto)

						
							<div class="col-md-6 mb-4">
								<div class="row">
									<div class="col">
										<h6>{{ title_case($producto->nombre) }}</h6>
										<p>{{ $producto->descripcion }}</p>
										<h6>${{ number_format($producto->precio) }}</h6>
									</div>
									<div class="col-3">
										<a class="btn btn-danger rounded-circle btn-small" href="{{ route('agregar.carrito' , $producto->id) }}">
											<i class="fa fa-plus"></i>
										</a>
									</div>
								</div>
							</div>
						

					@endforeach

					</div>
					  </div>
					  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
					  	<p>{{ $tienda->negocio != null ? $tienda->negocio->descripcion : '' }}</p>
					  </div>
					  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
			</div>

					
					
				</div>

				<div class="col-4 pt-4 pb-4 mt-4 mb-4 d-none d-lg-block">
					<div class="row">
						<div class="col text-center border p-4">
							<h6 class="mb-4">Mi Pedido{{ Cart::count() > 0 ? ' '.Cart::count() : ''}}</h6>
									@if(Cart::count() == 0)
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
									@foreach(Cart::content() as $carro)
									<div class="row mb-4 text-left">
										<div class="col-2">{{ $carro->qty }}</div>
										<div class="col">{{ $carro->name }}</div>
										<div class="col">${{ number_format($carro->price) }}</div>
									</div>
									<hr>
									@endforeach

									<div class="row text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										<div class="col"><strong>${{ Cart::subtotal(0, ',', '.') }}</strong></div>
									</div>

									@endif
						</div>
					</div>
				</div>
	</div>
</div>
@endsection