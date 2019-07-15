@component('mail::message')
# Su orden Nº {{ $orden->id }} cambio su estatus a {{ $orden->verEstatus($orden->estatus) }}

Para más detalles ingresa a tu cuenta.

@component('mail::button', ['url' => url('/')])
Ingresar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent