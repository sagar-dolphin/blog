@component('mail::message')
# {{ $mailData['title'] }}
  
The body of your message.
  
@component('mail::button', ['url' => $mailData['url']])
Verify Your Email
@endcomponent
  
Thanks,

{{ config('app.name') }}
@endcomponent