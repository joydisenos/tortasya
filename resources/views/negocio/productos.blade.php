@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Productos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">


				<div class="row">
					<div class="col mb-4 text-right">
						<a href="{{ route('negocio.crear.producto') }}" class="btn btn-danger">
							Nuevo Producto
						</a>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<th>Nombre</th>
									<th>Precio</th>
									<th>Ventas</th>
									<th>Estatus</th>
									<th></th>
								</thead>
							</table>
						</div>
					</div>
				</div>
			
			
		</div>
	</div>
</div>
@endsection