@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Ordenar')
@endcomponent

<div class="container">
	<div class="row">
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="row">
				<div class="col-md-6 text-center p-4">
							<h6 class="mb-4">Mi Pedido <span class="badge badge-danger">{{ $carrito->count() > 0 ? ' '.$carrito->count() : ''}}</span></h6>
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
										<div class="col"><strong>Sub total:</strong></div>
										<div class="col"><strong>${{ $total }}</strong></div>
									</div>

									<hr>

									@if($tienda->negocio->entrega_domicilio == 1)
									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Envío:</strong></div>
										@if($tienda->negocio->costo_fijo != 0 && $tienda->negocio->costo_envio != 0 && $tienda->negocio->envio_gratis == 0)
										<div class="col"><strong>${{ $envio = $tienda->negocio->costo_envio }}</strong></div>
										@endif

										@if($tienda->negocio->envio_gratis == 1)
										<div class="col"><strong>$0</strong></div>
										@endif

										@if($tienda->negocio->variable == 1)
										<div class="col"><strong>Variable</strong></div>
										@endif
									</div>

									<hr>
									@endif

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										
											
											@if(isset($envio))
											<div class="col"><strong>${{ $total + $envio}}</strong></div>
											@else
											<div class="col"><strong>${{ $total }}</strong></div>
											@endif
							

				
									</div>

									@endif
				</div>

				<div class="col-md-6 p-4">
					
					<form action="{{ route('pago' , [$slug]) }}" method="post">
						@csrf

						<h6>Seleccione su Dirección</h6>

						@foreach(Auth::user()->direcciones as $direccion)
							<input type="radio" name="direccion_id" class="mb-4" id="d-{{$direccion->id}}" value="{{ $direccion->id }}" required> <label for="d-{{$direccion->id}}">{{ $direccion->direccion }}</label> <br>
						@endforeach

						<hr>

						<h6>Seleccione su método de pago</h6>
						@if($tienda->negocio->tarjeta_delivery == 1)
						<input type="radio" name="pago" id="p-1" value="Tarjeta al delivery" required> <label for="p-1">Tarjeta al delivery</label> <br>
						@endif

						@if($tienda->negocio->envio_entrega == 1)
						<input type="radio" name="pago" id="p-2" value="Envío contra entrega" required> <label for="p-2">Envío contra entrega</label>
						@endif

						<hr>

						<h6>Datos de envío</h6>
						@if($tienda->negocio->entrega_local == 1)
						<input type="radio" name="envio" id="e-1" value="Retiro al Local" required> <label for="e-1">Retiro al Local</label> <br>
						@endif

						@if($tienda->negocio->entrega_domicilio == 1)
						<input type="radio" name="envio" id="e-2" value="Delivery" required> <label for="e-2">Delivery</label>
						<hr>
						@endif

						<div class="text-center">
							<button class="btn btn-danger" type="submit">Finalizar Compra</button>
						</div>

					</form>
					
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection