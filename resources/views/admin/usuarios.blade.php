@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Usuarios')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">
			
			<div class="row mb-4">
				<div class="col">
					<input type="text" id="buscar" class="form-control" placeholder="Buscar">
				</div>
			</div>
			<div class="row">
				<div class="col">
					
					<div class="table-responsive">
						<table class="table">
							<thead>
								<th>Nombre</th>
								<th>Email</th>
								<th>Tipo</th>
								<th>Descatado</th>
								<th>Destacar</th>
							</thead>
							<tbody class="list">
								@foreach($usuarios as $user)
								<tr>
									<td>{{ title_case($user->nombre) }} {{ title_case($user->apellido) }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->nombre_negocio != null ? 'Negocio' : 'Usuario' }}</td>
									<td>
										@if( $user->negocio != null )
											@if( Carbon\Carbon::now()->format('Y-m-d') <= $user->negocio->destacado)
												{{ Carbon\Carbon::now()->diffInDays($user->negocio->destacado) + 1 }} Días
											@endif
										@endif
									</td>
									<td>
										@if( $user->negocio != null )
											<form action="{{ route('admin.destacar' , $user->negocio->id) }}" method="post">
												@csrf
												<div class="row">
													<div class="col-8">
														<input type="number" name="dias" class="form-control" min="0" placeholder="Días">
													</div>
													<div class="col-4">
														<button class="btn btn-danger">+</button>
													</div>
												</div>
											</form>
										@endif
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