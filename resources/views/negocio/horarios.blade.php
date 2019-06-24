@extends('master.front')
@section('header')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<style>
	.hidden{
		display:none;
	}
</style>
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Horarios y envíos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">


				<form action="{{ route('negocio.actualizar.horario') }}" method="post">
					@csrf

					<div class="row mb-4">
						<div class="col text-right">
							<button type="submit" class="btn btn-danger">
								Actualizar
							</button>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Lunes</p>
						</div>
						<div class="col">
							<input type="time" name="d_lunes" value="{{ $horario != null ? $horario->Mon[0] : '' }}" class="form-control time" name="">
						</div>
						<div class="col">
							<input type="time" name="h_lunes" value="{{ $horario != null ? $horario->Mon[1] : '' }}" class="form-control time" name="">
						</div>
					</div>
					<hr>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Martes</p>
						</div>
						<div class="col">
							<input type="time" name="d_martes" value="{{ $horario != null ? $horario->Tue[0] : '' }}" class="form-control time" name="">
						</div>
						<div class="col">
							<input type="time" name="h_martes" value="{{ $horario != null ? $horario->Tue[1] : '' }}" class="form-control time" name="">
						</div>
					</div>
					<hr>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Miercoles</p>
						</div>
						<div class="col">
							<input type="time" name="d_miercoles" value="{{ $horario != null ? $horario->Wed[0] : '' }}" class="form-control time" name="">
						</div>
						<div class="col">
							<input type="time" name="h_miercoles" value="{{ $horario != null ? $horario->Wed[1] : '' }}" class="form-control time" name="">
						</div>
					</div>
					<hr>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Jueves</p>
						</div>
						<div class="col">
							<input type="time" name="d_jueves" value="{{ $horario != null ? $horario->Thu[0] : '' }}" class="form-control time" name="">
						</div>
						<div class="col">
							<input type="time" name="h_jueves" value="{{ $horario != null ? $horario->Thu[1] : '' }}" class="form-control time" name="">
						</div>
					</div>
					<hr>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Viernes</p>
						</div>
						<div class="col">
							<input type="time" name="d_viernes" value="{{ $horario != null ? $horario->Fri[0] : '' }}" class="form-control time" name="">
						</div>
						<div class="col">
							<input type="time" name="h_viernes" value="{{ $horario != null ? $horario->Fri[1] : '' }}" class="form-control time" name="">
						</div>
					</div>
					<hr>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Sábado</p>
						</div>
						<div class="col">
							<input type="time" name="d_sabado" value="{{ $horario != null ? $horario->Sat[0] : '' }}" class="form-control time" name="">
						</div>
						<div class="col">
							<input type="time" name="h_sabado" value="{{ $horario != null ? $horario->Sat[1] : '' }}" class="form-control time" name="">
						</div>
					</div>
					<hr>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Domingo</p>
						</div>
						<div class="col">
							<input type="time" name="d_domingo" value="{{ $horario != null ? $horario->Sun[0] : '' }}" class="form-control time" name="">
						</div>
						<div class="col">
							<input type="time" name="h_domingo" value="{{ $horario != null ? $horario->Sun[1] : '' }}" class="form-control time" name="">
						</div>
					</div>
					<hr>

					<div class="row mb-4">
						<div class="col">
							<h6>
								Formas de envío
							</h6>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Entregas a Domicilio?</p>
						</div>
						<div class="col">
						

							<span class="button-checkbox">
						        <button type="button" class="btn" data-color="danger"></button>
						        <input type="checkbox"  class="hidden"  name="entrega_domicilio" {{ $negocio->entrega_domicilio == 1 ? 'checked' : '' }}/>
						    </span>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Se puede retirar por el local?</p>
						</div>
						<div class="col">

							<span class="button-checkbox">
						        <button type="button" class="btn" data-color="danger"></button>
						        <input type="checkbox"  class="hidden"  name="entrega_local" {{ $negocio->entrega_local == 1 ? 'checked' : '' }}/>
						    </span>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col">
							<h6>
								Formas de pago
							</h6>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Tarjeta al delivery</p>
						</div>
						<div class="col">

							<span class="button-checkbox">
						        <button type="button" class="btn" data-color="danger"></button>
						        <input type="checkbox"  class="hidden" name="tarjeta_delivery" {{ $negocio->tarjeta_delivery == 1 ? 'checked' : '' }}/>
						    </span>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Envío contra entrega</p>
						</div>
						<div class="col">
							<span class="button-checkbox">
						        <button type="button" class="btn" data-color="danger"></button>
						        <input type="checkbox"  class="hidden" name="envio_entrega" {{ $negocio->envio_entrega == 1 ? 'checked' : '' }}/>
						    </span>

						</div>
					</div>

					<div class="row mb-4">
						<div class="col">
							<h6>
								Costo de envíos
							</h6>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Envío Gratis</p>
						</div>
						<div class="col">

							<span class="button-checkbox">
						        <button type="button" class="btn" data-color="danger"></button>
						        <input type="checkbox"  class="hidden" name="envio_gratis" {{ $negocio->envio_gratis == 1 ? 'checked' : '' }}/>
						    </span>

						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Variable según zona</p>
						</div>
						<div class="col">

							 <span class="button-checkbox">
						        <button type="button" class="btn" data-color="danger"></button>
						        <input type="checkbox"  class="hidden" name="variable" {{ $negocio->variable == 1 ? 'checked' : '' }}/>
						    </span>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Costo fijo</p>
						</div>
						<div class="col">
							 <span class="button-checkbox">
						        <button type="button" class="btn" data-color="danger"></button>
						        <input type="checkbox"  class="hidden" name="costo_fijo" {{ $negocio->costo_fijo == 1 ? 'checked' : '' }}/>
						    </span>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Costo de envío</p>
						</div>
						<div class="col">
							<input type="number" class="form-control" name="costo_envio" value="{{ $negocio->costo_envio }}">
						</div>
					</div>
					
				</form>
			
			
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script>
        $('.time').each(function(){
        	$(this).timepicker();
        });

        $(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active')
                    .text('Activado');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default')
                    .text('Desactivado');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});
    </script>
@endsection