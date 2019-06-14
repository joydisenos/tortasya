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
<!-- SLIDER -->
    <section class="slider d-flex align-items-center">
        <!-- <img src="{{ asset('images/slider.jpg')}}" class="img-fluid" alt="#"> -->
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="slider-title_box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slider-content_wrap">
                                    <h3 class="text-white"><strong>Tortas a domicilio online</strong></h3>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-10">
                                <form class="form-wrap mt-4" method="post" action="{{ route('buscar.negocios.ciudad') }}">
                                    @csrf
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <select name="ciudad" class="btn-group1" required>
                                            
                                            <option value="Metropolitana de Santiago">Metropolitana de Santiago</option>
                                           
                                        </select>
                                        <!--<input type="text" placeholder="Distrito / Barrio" class="btn-group2">-->
                                        <select name="region" class="btn-group2" required>
                                            <option value="">Seleccione Una Región</option>
                                            
                                            @foreach($regiones as $region)
                                            <option value="{{ $region }}">{{ $region }}</option>
                                            @endforeach
                                           
                                        </select>
                                        <button type="submit" class="btn-form"><span class="icon-magnifier search-icon"></span>Buscar<i class="pe-7s-angle-right"></i></button>
                                    </div>
                                    <h6 class="text-white mt-3">Indicanos tu dirección</h6>
                                </form>
                                <div class="slider-link">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// SLIDER -->
    <!--//END HEADER -->
    <!--============================= FIND PLACES =============================-->
    
    <!--//END FIND PLACES -->
    <!--============================= FEATURED PLACES =============================-->
    <section class="main-block light-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="styled-heading">
                        <h3>Destacados</h3>
                    </div>
                </div>
            </div>
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
                                        @if( Auth::user()->favoritos->where('negocio_id' , $tienda->id)->count() > 0 )

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
    </section>
   @guest

    <section class="main-block light-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="add-listing-wrap">
                        <h2>¿Quieres publicar con nosotros?</h2>
                        <p>Nuestra plataforma le abrirá la puerta a tu negocio a exponerte a miles de clientes</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="featured-btn-wrap">
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#registro-modal"><span class="ti-plus"></span> Regístrate</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    @endguest
@endsection