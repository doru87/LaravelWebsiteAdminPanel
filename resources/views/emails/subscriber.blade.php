@component('mail::message')
# Introduction

The body of your message.
O noua barca a fost adaugata 
<img src="{{ asset('files/'.$boat->image) }}" class="img-fluid" alt="">

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
