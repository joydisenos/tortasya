<div class="col-md-3 pt-4 pb-4 mt-4 mb-4">

	<div class="text-center">
		<img src="{{ asset('images/perfil.png') }}" style="max-width: 100px;" class="img-fluid rounded-circle" alt="">
		<h6 class="m-3">{{ title_case(Auth::user()->nombre) }}</h6>
	</div>
	<ul class="list-group list-group-flush">

		@role('negocio|dev')
		<a href="{{ route('negocio.productos') }}">
		  	<li class="list-group-item {{ (URL::current() == route('negocio.productos')) ? 'active' : ''}}">
			  	Productos
			</li>
		</a>
		@else
		<a href="{{ route('usuario.favoritos') }}">
		  	<li class="list-group-item {{ (URL::current() == route('usuario.favoritos')) ? 'active' : ''}}">
			  	Favoritos
			</li>
		</a>
		<a href="{{ route('usuario.direcciones') }}">
		  	<li class="list-group-item {{ (URL::current() == route('usuario.direcciones')) ? 'active' : ''}}">
			  	Direcciones
			</li>
		</a>
		<a href="{{ route('usuario.datos') }}">
		  	<li class="list-group-item {{ (URL::current() == route('usuario.datos')) ? 'active' : ''}}">
			  	Datos
			</li>
		</a>
		<a href="{{ route('usuario.pedidos') }}">
		  	<li class="list-group-item {{ (URL::current() == route('usuario.pedidos')) ? 'active' : ''}}">
			  	Pedidos
			</li>
		</a>
		@endrole

		<a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
		  	<li class="list-group-item">
			  	Salir
			</li>
		</a>
	</ul>

</div>