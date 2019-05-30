<div class="col-md-3">

	<div class="text-center">
		<img src="{{ asset('images/perfil.png') }}" style="max-width: 100px;" class="img-fluid rounded-circle" alt="">
		<h6 class="m-3">{{ title_case(Auth::user()->nombre) }}</h6>
	</div>
	<ul class="list-group list-group-flush">
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

		<a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
		  	<li class="list-group-item">
			  	Salir
			</li>
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
	</ul>

</div>