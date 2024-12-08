@component('mail::message')
# Password reset request for account - {{ $username }}

We received a request to reset the password for your account. 

To reset your password, please click the link below.

@component('mail::button', ['url' => $url, 'color' => 'success'])
Reset Password
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent