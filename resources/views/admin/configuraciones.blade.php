@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Configuraciones')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">
			
		</div>
	</div>
</div>
@endsection