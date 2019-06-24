@component('mail::message')
# Su orden Nº {{ $orden->id }} cambio su estatus a entregado

Puedes comentar desde el panel de usuario como fué tu experiencia!.

@component('mail::button', ['url' => url('/')])
Ingresar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
