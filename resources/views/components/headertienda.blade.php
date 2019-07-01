<section class="header-panel">
	<div class="pantalla  d-flex align-items-end p-4">
		<div class="container">
			

			<div class="row">
			<div class="col-9 align-items-center d-flex">
				{{ $logo }}
				<h4 class="text-white d-inline">{{$titulo}}</h4>
				<a class="btn btn-outline-light ml-4 medios-pago d-none d-lg-block" href="#">Medios de pago</a>
				<div class="pagos">
					<ul class="list-unstyled">
					@if($tienda->negocio->tarjeta_delivery != 0)
						<li class="mb-4">Tarjeta al delivery</li>
					@endif

					@if($tienda->negocio->deposito_banco != 0)
						<li class="mb-4">Depósito Bancario</li>
					@endif

					@if($tienda->negocio->red_compra != 0)
						<li class="mb-4">Red Compra</li>
					@endif

					@if($tienda->negocio->envio_entrega != 0)
						<li class="mb-4">Abono 50% y 50% contra entrega</li>
					@endif
					</ul>
				</div>
			</div>
			<div class="col text-right">
				<h4 class="text-white">{{$puntos}}</h4>
			</div>
			</div>
			
			
		</div>
	</div>

</section>