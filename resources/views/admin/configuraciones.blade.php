@extends('master.front')

@section('content')

@component('components.header')
    @slot('titulo' , 'Configuraciones')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

	
			
				<div class="row">
					<div class="col">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<th>Sección</th>
									<th>Texto</th>
									<th>Modificar</th>
								</thead>
								<tbody>
									@foreach($legales as $legal)
									<tr>
										<td>{{ title_case($legal->nombre) }}</td>
										<td>{{ str_limit($legal->texto , 30) }}</td>
										<td>
											<a href="{{ route('admin.editar.seccion' , $legal->slug) }}">
												Modificar
											</a>
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
