@extends('master.front')
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
                                <form class="form-wrap mt-4">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <select name="ciudad" class="btn-group1">
                                            <option value="">Seleccione Una Ciudad</option>
                                        </select>
                                        <input type="text" placeholder="Distrito / Barrio" class="btn-group2">
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
                            <img src="{{ asset('images/featured1.jpg')}}" class="img-fluid" alt="#">
                            <span class="featured-rating-orange">6.5</span>
                            <div class="featured-title-box">
                                <h6>{{ title_case($tienda->nombre_negocio) }}</h6>
                                <p>Restaurant </p> <span>• </span>
                                <p>3 Reviews</p> <span> • </span>
                                <p><span>$$$</span>$$</p>
                                <ul>
                                    <li><span class="icon-location-pin"></span>
                                        <p>{{ $tienda->direccion }}</p>
                                    </li>
                                    <li><span class="icon-screen-smartphone"></span>
                                        <p>{{ $tienda->telefono }}</p>
                                    </li>

                                </ul>
                                <div class="bottom-icons">
                                    <div class="open-now">Abierto</div>
                                    <span class="ti-heart"></span>
                                   
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
               
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="featured-btn-wrap">
                        <a href="#" class="btn btn-danger">VIEW ALL</a>
                    </div>
                </div>
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