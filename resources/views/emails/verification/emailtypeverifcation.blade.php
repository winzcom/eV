@component('mail::message')
EventPad

Thank you for considering EventPad, we are glad to have you.

@component('mail::button', ['url' => $url])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
