<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
@component('mail::message')
# {{ $mailData['title'] }}

Please Enter OTP to verify
<h3>Otp: {{$mailData['otp']}}</h3>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
