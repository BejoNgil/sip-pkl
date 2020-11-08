@component('mail::message')
Hello **{{$name}}**,  {{-- use double space for line break --}}
Silahkan lakukan aktivasi email.

Dengan melakukan tombol klik link dibawah ini
@component('mail::button', ['url' => $link])
Verifikasi
@endcomponent
Admin,
Kampung Marketer.
@endcomponent
