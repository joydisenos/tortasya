@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Mis Ventas')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col-md-9 pt-4 pb-4 mt-4 mb-4">

			<div class="row mb-4">
				<div class="col">
					<input type="text" id="buscar" class="form-control" placeholder="Buscar">
				</div>
			</div>

			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Orden</th>
						<th>Usuario</th>
						<th>Productos</th>
						<th>Envío</th>
						<th>Pago</th>
						<th>Total</th>
						<th>Detalles</th>
						<th>Estatus</th>
						<th>Eliminar</th>
					</thead>
					<tbody class="list">
						@foreach($ventas as $venta)
						<tr>
							<td>{{ $venta->id }}</td>
							<td>{{ $venta->user->nombre }}</td>
							<td>{{ $venta->productos->count() }}</td>
							<td>{{ $venta->envio }}</td>
							<td>{{ $venta->pago }}</td>
							<td class="text-right">${{ number_format($venta->total , 0  , ',' , '.') }}</td>
							<td><a href="{{ route('negocio.venta.orden' , $venta->id) }}" class="btn btn-danger"><i class="fa fa-eye"></i></a></td>
							<td>
								@if( $venta->estatus == 3)
								{{ $venta->verEstatus($venta->estatus) }}
								@else
								<select name="estatus" id="estatus-{{ $venta->id }}" class="cambiar-estatus" class="form-control" style="border:none; width: 200px">
									<option value="0" data-link="{{ route('negocio.estatus.orden' , [$venta->id , 0]) }}" {{ $venta->estatus == 0 ? 'selected' : '' }}>Fallido</option>
									<option value="1" data-link="{{ route('negocio.estatus.orden' , [$venta->id , 1]) }}" {{ $venta->estatus == 1 ? 'selected' : '' }}>Pendiente de entrega</option>
									<option value="2" data-link="{{ route('negocio.estatus.orden' , [$venta->id , 2]) }}" {{ $venta->estatus == 2 ? 'selected' : '' }}>Entregado o Recepcionado</option>
									<option value="4" data-link="{{ route('negocio.estatus.orden' , [$venta->id , 4]) }}" {{ $venta->estatus == 4 ? 'selected' : '' }}>En espera de contacto</option>
									<option value="5" data-link="{{ route('negocio.estatus.orden' , [$venta->id , 5]) }}" {{ $venta->estatus == 5 ? 'selected' : '' }}>Trabajando</option>
								</select>
								@endif
							</td>
							
							<td>
								<a href="{{ route('negocio.estatus.orden' , [$venta->id , 6]) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
			
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
        $(document).ready(function(){
            $("#buscar").keyup(function(){
            _this = this;
           
              $.each($(".list tr"), function() {
                  if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                  $(this).hide();
                  else
                  $(this).show();
              });
            });

            $('.cambiar-estatus').change( function(){

            	link = $(this).find('option:selected').data('link');
            	window.location.replace(link);
            });
        });
  </script>
@endsection