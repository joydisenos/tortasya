<div class="col-md-3 pt-4 pb-4 mt-4 mb-4">
	
	
	
	<ul class="list-group list-group-flush">

		
		<a href="{{ route('nosotros') }}">
		  	<li class="list-group-item {{ (URL::current() == route('nosotros')) ? 'active' : ''}}">
			  	Nosotros
			</li>
		</a>

		<a href="{{ route('nosotros.pagina' , 'beneficios-para-los-consumidores') }}">
		  	<li class="list-group-item {{ (URL::current() == route('nosotros.pagina' , 'beneficios-para-los-consumidores') )? 'active' : ''}}">
			  	Beneficios para los Consumidores
			</li>
		</a>

		<a href="{{ route('nosotros.pagina' , 'beneficios-para-las-empresas-emprendedores-y-pastelerias') }}">
		  	<li class="list-group-item {{ (URL::current() == route('nosotros.pagina' , 'beneficios-para-las-empresas-emprendedores-y-pastelerias') )? 'active' : ''}}">
			  	Beneficios para las empresas, emprendedores y Pastelerías
			</li>
		</a>

		<a href="{{ route('nosotros.pagina' , 'preguntas-frecuentes') }}">
		  	<li class="list-group-item {{ (URL::current() == route('nosotros.pagina' , 'preguntas-frecuentes') )? 'active' : ''}}">
			  	Preguntas Frecuentes
			</li>
		</a>

		<a href="{{ route('nosotros.pagina' , 'terminos-y-condiciones') }}">
		  	<li class="list-group-item {{ (URL::current() == route('nosotros.pagina' , 'terminos-y-condiciones') )? 'active' : ''}}">
			  	Términos y Condiciones
			</li>
		</a>

		
	</ul>

</div>