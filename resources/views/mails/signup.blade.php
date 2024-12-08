@component('mail::message')
# Registration Completed.
 
We are happy you signed up for **PassNumber**. Please confirm your your email address to access the site.
 
@component('mail::button', ['url' => $url, 'color' => 'success'])
Verify
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent