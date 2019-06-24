@extends('master.front')
@section('header')
<style>
    .imagen-tienda{
        height: 200px;
        background-size: cover;
        background-position: center center;
    }
</style>
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Favoritos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4 {{ $favoritos->count() == 0 ? 'align-items-center d-flex text-center justify-content-center' : '' }}">

			<div class="row {{ $favoritos->count() == 0 ? 'justify-content-center' : '' }}">

				@if($favoritos->count() == 0)

				<div class="col text-center">
					<h3 class="color-primary mb-4">Aún no tienes negocios Favoritos</h3>
					<a href="{{ url('/') }}" class="btn btn-danger">Comenzar Ahora</a>
				</div>
				@endif

				@foreach($favoritos as $favorito)
                <div class="col-md-4 featured-responsive">
                    <div class="featured-place-wrap">
                        <a href="{{ route('tienda' , [$favorito->tienda->slug]) }}">
                            
                            <div class="imagen-tienda" style="background-image:url('{{ $favorito->tienda->negocio != null && $favorito->tienda->negocio->foto_local != null ? asset('storage/archivos/' . $favorito->tienda->id . '/' . $favorito->tienda->negocio->foto_local) : asset('images/cake.jpg')}}')"></div>
                            <span class="featured-rating-orange">{{ number_format($favorito->tienda->puntaje($favorito->tienda->id) , 1) }}</span>
                            <div class="featured-title-box">
                                <h6>{{ title_case($favorito->tienda->nombre_negocio) }}</h6>
                                <!--<p>Restaurant </p> <span>• </span>
                                <p> Comentarios</p> <span> • </span>-->
                                <!--<p><span>$$$</span>$$</p>-->
                                <ul>
                                    <li><span class="icon-location-pin"></span>
                                        <p>{{ $favorito->tienda->direccion }}</p>
                                    </li>
                                    <li><span class="icon-screen-smartphone"></span>
                                        <p>{{ $favorito->tienda->telefono }}</p>
                                    </li>

                                </ul>
                                <div class="bottom-icons">

                                    <div class="{{ $favorito->tienda->horarioDisponible() == 'Abierto'? 'open' : 'closed'}}-now">{{ $favorito->tienda->horarioDisponible() }}</div>
                                    @guest
                                    @else

                                    @if( Auth::user()->favoritos->where('negocio_id' , $favorito->tienda->id) )
                                    <a href="{{ route('marcar.favorito' , $favorito->tienda->id) }}">
                                        <span class="fa fa-heart text-danger"></span>
                                    </a>
                                    @else
                                    <a href="{{ route('marcar.favorito' , $favorito->tienda->id) }}">
                                        <span class="ti-heart"></span>
                                    </a>
                                    @endif
                                    
                                    @endguest
                                   
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
			</div>
			
		</div>
	</div>
</div>
@endsection