@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Crear Producto')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<form action="{{ route('negocio.guardar.producto') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row mb-4">
					<div class="col"></div>
					<div class="col">
						<input type="file" name="foto" id="imagen-producto" class="form-control d-none" onchange='cambiar()'>
						<label for="imagen-producto" class="btn btn-danger" style="cursor: pointer">
						    <i class="fa fa-upload"></i> Adjunta la imagen de tu Producto
						</label>
						<div id="info"></div>
					</div>
				</div>

				<div class="row mb-4">

					<div class="col">
						<label>Nombre del Producto</label>
						<input type="text" name="nombre" placeholder="Nombre" class="form-control">
					</div>

					<div class="col">
						<label>Precio del Producto</label>
						<input type="number" step="0.01" name="precio" placeholder="Precio" class="form-control">
					</div>
					
				</div>

				<div class="row mb-4">
					<div class="col">
						<label>Descripcion del producto</label>
						<textarea name="descripcion" placeholder="Descripción" cols="30" rows="10" class="form-control"></textarea>
					</div>
				</div>

				<div class="row mb-4">
					<div class="col">
						<label>Observaciones Adicionales</label>
						<input type="text" name="sabores" placeholder="Observaciones Adicionales" class="form-control">
					</div>
				</div>

				<div class="row mb-4">
					<div class="col">
						<button class="btn btn-danger">
							Crear
						</button>
					</div>
				</div>

			</form>
			
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
	function cambiar(){
    var pdrs = document.getElementById('imagen-producto').files[0].name;
    document.getElementById('info').innerHTML = pdrs;
}
</script>
@endsection