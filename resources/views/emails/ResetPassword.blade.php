@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => $mailData['url']])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
