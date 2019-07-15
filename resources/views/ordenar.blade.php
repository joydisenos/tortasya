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
										<div class="col">${{ number_format($total += $carro->price * $carro->qty , 0  , ',' , '.') }}</div>
									</div>
									<hr>
									@endforeach

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Sub total:</strong></div>
										<div class="col"><strong>${{ number_format($total , 0  , ',' , '.') }}</strong></div>
									</div>

									<hr>

									@if($tienda->negocio->entrega_domicilio == 1)
									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Envío:</strong></div>
										@if($tienda->negocio->costo_fijo != 0 && $tienda->negocio->costo_envio != 0 && $tienda->negocio->envio_gratis == 0)
										<div class="col"><strong>${{ $envio = number_format($tienda->negocio->costo_envio , 2  , ',' , '.') }}</strong></div>
										@endif

										@if($tienda->negocio->envio_gratis == 1)
										<div class="col"><strong>$0</strong></div>
										@elseif($tienda->negocio->variable == 1)
										<div class="col"><strong>Variable</strong></div>
										@endif
									</div>

									<hr>
									@endif

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										
											
											@if(isset($envio))
											<div class="col"><strong>${{ number_format($total + $envio , 0  , ',' , '.') }}</strong></div>
											@else
											<div class="col"><strong>${{ number_format($total , 0  , ',' , '.') }}</strong></div>
											@endif
							

				
									</div>

									@endif
				</div>

				<div class="col-md-6 p-4">
					
					<form action="{{ route('pago' , [$slug]) }}" method="post">
						@csrf

						<div class="row mb-4">
							<div class="col text-right">
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#agregar_direccion">
								  Agregar Dirección
								</button>
							</div>
						</div>

						<h6>Seleccione su Dirección</h6>
						
						<table class="table">
							<thead>
								<th></th>
								<th>Ciudad</th>
								<th>Comuna</th>
								<th>Calle</th>
							</thead>
							<tbody>
								@foreach(Auth::user()->direcciones as $direccion)
							<tr>
								<td>
									
							<input type="radio" name="direccion_id" class="mb-4" id="d-{{$direccion->id}}" value="{{ $direccion->id }}" required> 
						
								</td>

								<td>
									<label for="d-{{$direccion->id}}">{{ $direccion->ciudad }}</label>
								</td>

								<td>
									<label for="d-{{$direccion->id}}">{{ json_decode($direccion->direccion) != null ?  json_decode($direccion->direccion)->comuna : '' }}</label>
								</td>

								<td>
									<label for="d-{{$direccion->id}}">{{ json_decode($direccion->direccion) != null ?  json_decode($direccion->direccion)->calle : '' }}</label>
								</td>
							</tr>
						@endforeach
							</tbody>
						</table>
						

						<hr>

						<h6>Seleccione su método de pago</h6>
						@if($tienda->negocio->tarjeta_delivery == 1)
						<input type="radio" name="pago" id="p-1" value="Tarjeta al delivery" required> <label for="p-1">Tarjeta al delivery</label> <br>
						@endif

						@if($tienda->negocio->envio_entrega == 1)
						<input type="radio" name="pago" id="p-2" value="Abono 50% y 50% contra entrega" required> <label for="p-2">Abono 50% y 50% contra entrega</label> <br>
						@endif

						@if($tienda->negocio->deposito_banco == 1)
						<input type="radio" name="pago" id="p-3" value="Depósito Bancario" required> <label for="p-3">Depósito Bancario</label> <br>
						@endif

						@if($tienda->negocio->red_compra == 1)
						<input type="radio" name="pago" id="p-4" value="Red Compra" required> <label for="p-4">Red Compra</label> <br>
						@endif



						<hr>

						<h6>Datos de envío</h6>
						@if($tienda->negocio->entrega_local == 1)
						<input type="radio" name="envio" id="e-1" value="Retiro al Local" required> <label for="e-1">Retiro al Local</label> <br>
						@endif

						@if($tienda->negocio->envio_convenir == 1)
						<input type="radio" name="envio" id="e-3" value="A convenir" required> <label for="e-3">A convenir</label> <br>
						@endif

						@if($tienda->negocio->entrega_domicilio == 1)
						<input type="radio" name="envio" id="e-2" value="Delivery" required> <label for="e-2">Delivery</label> <br>
						@endif
						<hr>



						<div class="text-center">
							<button class="btn btn-danger" type="submit">Comprar</button>
						</div>

					</form>
					
				</div>
			</div>
			
		</div>
	</div>
</div>

@include('includes.modaldireccion')
@endsection