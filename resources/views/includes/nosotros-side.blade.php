<div class="col-md-3 pt-4 pb-4 mt-4 mb-4">
	
	@guest
	@else
	<div class="text-center">
		<img src="{{ asset('images/perfil.png') }}" style="max-width: 100px;" class="img-fluid rounded-circle" alt="">
		<h6 class="m-3">{{ title_case(Auth::user()->nombre) }}</h6>
	</div>
	@endguest
	
	<ul class="list-group list-group-flush">

		
		<a href="{{ route('nosotros') }}">
		  	<li class="list-group-item {{ (URL::current() == route('nosotros')) ? 'active' : ''}}">
			  	<i class="fa fa-circle-o mr-3" aria-hidden="true"></i> Nosotros
			</li>
		</a>

		<a href="{{ route('nosotros.pagina' , 'beneficios-para-los-consumidores') }}">
		  	<li class="list-group-item {{ (URL::current() == route('nosotros.pagina' , 'beneficios-para-los-consumidores') )? 'active' : ''}}">
			  	<i class="fa fa-circle-o mr-3" aria-hidden="true"></i> Beneficios para los Consumidores
			</li>
		</a>

		<a href="{{ route('nosotros.pagina' , 'beneficios-para-las-empresas-emprendedores-y-pastelerias') }}">
		  	<li class="list-group-item {{ (URL::current() == route('nosotros.pagina' , 'beneficios-para-las-empresas-emprendedores-y-pastelerias') )? 'active' : ''}}">
			  	<i class="fa fa-circle-o mr-3" aria-hidden="true"></i> Beneficios para las empresas, emprendedores y Pastelerías
			</li>
		</a>

		<a href="{{ route('nosotros.pagina' , 'preguntas-frecuentes') }}">
		  	<li class="list-group-item {{ (URL::current() == route('nosotros.pagina' , 'preguntas-frecuentes') )? 'active' : ''}}">
			  	<i class="fa fa-circle-o mr-3" aria-hidden="true"></i> Preguntas Frecuentes
			</li>
		</a>

		<a href="{{ route('nosotros.pagina' , 'terminos-y-condiciones') }}">
		  	<li class="list-group-item {{ (URL::current() == route('nosotros.pagina' , 'terminos-y-condiciones') )? 'active' : ''}}">
			  	<i class="fa fa-circle-o mr-3" aria-hidden="true"></i> Términos y Condiciones
			</li>
		</a>

		

		<a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
		  	<li class="list-group-item">
			  	Salir
			</li>
		</a>
	</ul>

</div>