@component('mail::message')
# Bienvenid@ {{ title_case($user->name) }}

Conecta tu emprendimiento o negocio con miles de clientes en todo Chile! Comienza a publicar tus productos GRATIS!!!

@component('mail::button', ['url' => url('/') ])
Ingresar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
