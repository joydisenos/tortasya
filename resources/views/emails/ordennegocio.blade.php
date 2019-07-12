@component('mail::message')
# Orden Nº {{ $orden->id }}

Ha recibido un pedido de {{ title_case($orden->user->nombre) }} {{ title_case($orden->user->apellido) }}.

<div class="info">

				<div class="row mb-4">
					<div>
						<p>Usuario: <strong>{{ title_case($orden->user->nombre) }} {{ title_case($orden->user->apellido) }}</strong></p>
					</div>
				</div>

				<hr>

				<div class="row mb-4">
					<div>
						<p>Email: <strong>{{ $orden->user->email }}</strong></p>
					</div>
				</div>

				<hr>

				<div class="row mb-4">
					<div>
						<p>Teléfono: <strong>{{ $orden->user->telefono }}</strong> <a target="_blank" class="ml-4 btn btn-success" href="https://wa.me/{{ str_slug($orden->user->telefono) }}">Comunícate directo por Whatsapp <i class="fa fa-whatsapp"></i></a></p>
					</div>
				</div>

				<hr>

				<div class="row mb-4">
					<div>
						<p>Envío: <strong>{{ $orden->envio }}</strong></p>
					</div>
				</div>

				<hr>

				<div class="row mb-4">
					<div class="col-4">
						<p>Pago: <strong>{{ $orden->pago }}</strong></p>
					</div>
				</div>

				<hr>

				@if($orden->direccion_id > 0)
				<div class="row mb-4">
					<div>
						<h4>Dirección de envío</h4>
						<p>Ciudad: <strong>{{ $orden->direccion->ciudad }}</strong></p>
						<p>Comuna: <strong>{{ $orden->verDireccion($orden->direccion_id)->comuna }}</strong></p>
						<p>Calle: <strong>{{ $orden->verDireccion($orden->direccion_id)->calle }}</strong></p>
						<p>Número: <strong>{{ $orden->verDireccion($orden->direccion_id)->numero }}</strong></p>
						<p>Departamento: <strong>{{ $orden->verDireccion($orden->direccion_id)->departamento }}</strong></p>
						<p>Referencia: <strong>{{ $orden->verDireccion($orden->direccion_id)->referencia }}</strong></p>
					</div>
				</div>
					
				@endif

				<div class="row mb-4">
					<div class="col">
						<div class="text-center mb-4">
							<h4>Pedido</h4>
						</div>
						<div>
							<table style="width: 100%">
								<thead>
									<th>Producto</th>
									<th>Sabor</th>
									<th>Cantidad</th>
									<th>Precio</th>
								</thead>
								<tbody>
									@foreach($orden->productos as $producto)
									<tr>
										<td>
											{{ $producto->producto->nombre }}
										</td>
										<td>
											{{ json_decode($producto->opciones) != null ? json_decode($producto->opciones)->sabor : '' }}
										</td>
										<td style="text-align: center">{{ $producto->cantidad }}</td>
										<td style="text-align: right">${{ number_format($producto->producto->precio * $producto->cantidad , 0 , ',' , '.') }}</td>
									</tr>
									@endforeach
									@if($orden->envio == 'Delivery')
									<tr>
										<td></td>
										<td></td>
										<td>Envío:</td>
										<td style="text-align: right">${{ number_format($orden->negocio->negocio->costo_envio , 0 , ',' , '.') }}</td>
									</tr>
									@endif
									<tr>
										<td></td>
										<td></td>
										<td>Total Facturado:</td>
										<td style="text-align: right">${{ number_format($orden->total , 0 , ',' , '.') }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
</div>

@component('mail::button', ['url' => url('/')])
Ingresar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
