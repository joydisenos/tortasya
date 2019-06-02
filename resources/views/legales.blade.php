@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , $legal->nombre)
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nosotros-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">
			{!! $legal->texto !!}
		</div>
	</div>
</div>
@endsection