@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Usuarios')
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
			<div class="row">
				<div class="col">
					
					<div class="table-responsive" style="max-width: 100%; overflow-x: scroll;">
						<table class="table">
							<thead>
								<th>Nombre</th>
								<th>Teléfono</th>
								<th>Email</th>
								<th>Negocio</th>
								<th>Dirección</th>
								<th>Ciudad</th>
								<th>Region</th>
								<th>Estatus</th>
								<th></th>
								<th></th>
								
							</thead>
							<tbody class="list">
								@foreach($sugerencias as $item)
								<tr>
									<td>{{ title_case($item->nombre) }} {{ title_case($item->apellido) }}</td>
									<td>{{ $item->telefono }}</td>
									<td>{{ $item->email }}</td>
									<td>{{ $item->nombre_negocio }}</td>
									<td>{{ $item->direccion }}</td>
									<td>{{ $item->ciudad }}</td>
									<td>{{ $item->region }}</td>
									<td>{{ $item->verEstatus($item->estatus) }}</td>
									<td>
										<a href="{{ route('admin.sugerir' , [$item->id , 2]) }}" class="btn btn-success"><i class="fa fa-check"></i></a>
									</td>
									<td>
										<a href="{{ route('admin.sugerir' , [$item->id , 0]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
									</td>
									
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
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
        });
  </script>
@endsection