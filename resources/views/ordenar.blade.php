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
							<h6 class="mb-4">Mi Pedido <span class="badge badge-danger">{{ Cart::count() > 0 ? ' '.Cart::count() : ''}}</span></h6>
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
									@foreach($carrito as $carro)
									<div class="row mb-4 text-left">
										<div class="col-2">{{ $carro->qty }}</div>
										<div class="col">{{ $carro->name }} {{ $carro->options->sabor }}</div>
										<div class="col">${{ number_format($carro->price) }}</div>
									</div>
									<hr>
									@endforeach

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										<div class="col"><strong>${{ Cart::subtotal(0, ',', '.') }}</strong></div>
									</div>

									@endif
				</div>

				<div class="col-md-6 p-4">

					<h6>Seleccione su Dirección</h6>

					@foreach(Auth::user()->direcciones as $direccion)
						<input type="radio" name="direccion" class="mb-4" id="d-{{$direccion->id}}" value="{{ $direccion->id }}"> <label for="d-{{$direccion->id}}">{{ $direccion->direccion }}</label> <br>
					@endforeach

					<hr>

					<h6>Seleccione su método de pago</h6>
					<input type="radio" name="pago" id="p-1"> <label for="p-1">Acuerdo con el negocio</label> <br>
					<input type="radio" name="pago" id="p-2"> <label for="p-2">Mercado Pago</label>

					<hr>

					<h6>Datos de envío</h6>
					<input type="radio" name="envio" id="e-1"> <label for="e-1">Retiro al Local</label> <br>
					<input type="radio" name="envio" id="e-2"> <label for="e-2">Delivery</label>

					<hr>

					<div class="text-center">
						<button class="btn btn-danger">Finalizar Compra</button>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection