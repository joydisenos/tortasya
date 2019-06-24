@extends('master.front')
@section('header')
<style>
  .estrellas p {
  text-align: center;
}

.estrellas label {
  font-size: 20px;
}

.estrellas input[type="radio"] {
  display: none;
}

.estrellas label {
  color: grey;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
}

.estrellas label:hover,
.estrellas label:hover ~ .estrellas label {
  color: orange;
}

.estrellas input[type="radio"]:checked ~ label {
  color: orange;
}
</style>

@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Mis Pedidos')
@endcomponent

<div class="container">
	<div class="row align-items-center">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">
      
      @if($pedidos->count() > 0)
			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Orden</th>
						<th>Negocio</th>
            <th>Detalles</th>
						<th>Productos</th>
						<th>Envío</th>
						<th>Pago</th>
						<th>Estatus</th>
						<th></th>
					</thead>
					<tbody>
						@foreach($pedidos as $pedido)
						<tr>
							<td>{{ $pedido->id }}</td>
							<td>{{ $pedido->negocio->nombre_negocio }}</td>
              <td><a href="{{ route('usuario.ver.pedido' , $pedido->id ) }}" class="btn btn-danger"><i class="fa fa-eye"></i></a></td>
							<td>{{ $pedido->productos->count() }}</td>
							<td>{{ $pedido->envio }}</td>
							<td>{{ $pedido->pago }}</td>
							<td>{{ $pedido->verEstatus($pedido->estatus) }}</td>
							<td>
								@if($pedido->estatus == 2)
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#comment" data-pedido="{{$pedido->id}}">Comentar</button>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
      @else
      <div class="text-center">
        <h3 class="color-primary mb-4">Todavía no realizaste pedidos</h3>
        <h6 class="mb-4">¡Pruebanos ahora y te convertirás en fan!</h6>
        <a href="{{ url('/') }}" class="btn btn-danger">Comenzar Ahora</a>
      </div>
      @endif
			
		</div>
	</div>
</div>


<div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comentarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{ route('usuario.comentar') }}" method="post">
      <div class="modal-body">
       
          @csrf
          <input type="hidden" id="orden_id" name="orden_id">
          <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
          
          <div class="row">
            <div class="col-md-4">
               <label class="col-form-label">Valoración:</label>
            </div>
            <div class="col-md-8">
              <div class="estrellas">
          <p class="clasificacion">
            <input id="radio1" type="radio" name="puntos" value="5"><!--
            --><label for="radio1">★</label><!--
            --><input id="radio2" type="radio" name="puntos" value="4"><!--
            --><label for="radio2">★</label><!--
            --><input id="radio3" type="radio" name="puntos" value="3"><!--
            --><label for="radio3">★</label><!--
            --><input id="radio4" type="radio" name="puntos" value="2"><!--
            --><label for="radio4">★</label><!--
            --><input id="radio5" type="radio" name="puntos" value="1"><!--
            --><label for="radio5">★</label>
          </p>
          </div>
            </div>
          </div>
          

          <div class="form-group">
            <label for="message-text" class="col-form-label">Comentario:</label>
            <textarea class="form-control" id="message-text" name="comentario"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Comentar</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $('#comment').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var pedido = button.data('pedido') 


  var modal = $(this)
  modal.find('.modal-title').text('Comentarios')
  modal.find('#orden_id').val(pedido)
})
</script>
@endsection