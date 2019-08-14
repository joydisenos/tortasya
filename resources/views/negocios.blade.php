@extends('master.front')
@section('header')
<style>
	.principal{
		min-height: 90vh;
	}
	.contenedor{
		max-width: 300px;
		margin: 0 auto;
	}
	.contenedor img{
		box-shadow: 3px 3px 18px rgba(0,0,0,0.6);
	}
	.imagen-tienda{
        height: 200px;
        background-size: cover;
        background-position: center center;
    }
</style>
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Negocios en ' . title_case($region))
@endcomponent

<div class="container">
	<div class="row">
		
		<div class="col pt-4 pb-4 mt-4 mb-4 principal">

			@if($tiendas->count() == 0)
			<div class="text-center">
				<div class="contenedor">
					<a href="{{ url('/') }}">
						<img src="{{ asset('images/cake.jpg') }}" alt="TortasYa" class="img-fluid rounded-circle mb-4">
					</a>
				</div>
				<h3>En esta región no tenemos negocios registrados!</h3>
			</div>
			@endif

			<div class="row">
            @foreach($tiendas as $tienda)
                <div class="col-md-4 featured-responsive">
                    <div class="featured-place-wrap">
                        <a href="{{ route('tienda' , [$tienda->slug]) }}">
                            
                            <div class="imagen-tienda" style="background-image:url('{{ $tienda->negocio != null && $tienda->negocio->foto_local != null ? asset('storage/archivos/' . $tienda->id . '/' . $tienda->negocio->foto_local) : asset('images/cake.jpg')}}')"></div>
                            <span class="featured-rating-orange">{{ number_format($tienda->puntaje($tienda->id) , 1) }}</span>
                            <div class="featured-title-box">
                                <h6>{{ title_case($tienda->nombre_negocio) }}</h6>
                                <!--<p>Restaurant </p> <span>• </span>
                                <p> Comentarios</p> <span> • </span>-->
                                <!--<p><span>$$$</span>$$</p>-->
                                <ul>
                                    <li><span class="icon-location-pin"></span>
                                        <p>{{ $tienda->direccion }}</p>
                                    </li>
                                    <li><span class="icon-screen-smartphone"></span>
                                        <p>{{ $tienda->telefono }}</p>
                                    </li>

                                </ul>
                                <div class="bottom-icons">

                                    <div class="{{ $tienda->horarioDisponible() == 'Abierto'? 'open' : 'closed'}}-now">{{ $tienda->horarioDisponible() }}</div>
                                    @guest
                                    @else
                                    @if( Auth::user()->favoritos->where('negocio_id' , $tienda->id) )
                                    <a href="{{ route('marcar.favorito' , $tienda->id) }}">
                                        <span class="fa fa-heart text-danger"></span>
                                    </a>
                                    @else
                                    <a href="{{ route('marcar.favorito' , $tienda->id) }}">
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