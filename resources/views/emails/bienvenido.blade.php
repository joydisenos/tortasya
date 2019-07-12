@component('mail::message')
# Bienvenid@ {{ title_case($user->name) }}

Explora todas las delicias en tu ciudad y podrás solicitar ahora mismo un pedido!.

@component('mail::button', ['url' => url('/') ])
Ingresar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
