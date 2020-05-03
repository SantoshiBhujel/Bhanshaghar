@component('mail::message')
# Hello from Bhanshaghar !!!

Welcome to Bhanshaghar family. Drink and eat at a single click. Get 50% off on the very first order !
Use code NAYA50% to get the discount.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
