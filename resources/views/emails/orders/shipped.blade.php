@component('mail::message')
# Introduction

The body of your message. This is just a test mail 

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
