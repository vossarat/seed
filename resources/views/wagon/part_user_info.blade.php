<li><u>Разместил пользователь</u></li>

@if( $wagon->user->email )
<li>
    &nbsp;&nbsp;&bull;E-mail:
    @if( Auth::check() )
    <a href="mailto:{{ $wagon->user->email }}">
        {{$wagon->user->email }}
    </a>
    @else
    <a href="/login">
        *******
    </a>
    @endif
</li>
@endif
@if(  $wagon->user->phone )
<li>
    &nbsp;&nbsp;&bull;Телефон:
    @if( Auth::check() )
    <a href="tel:+{{Func::phoneOnlyNumber($wagon->user->phone)}}">
        {{ $wagon->user->phone }}
    </a>
    @else
    <a href="/login">
        *******
    </a>
    @endif
</li>
@endif
@if( $wagon->user->whatsapp )
<li>
    &nbsp;&nbsp;&bull;WhatsApp:
    @if( Auth::check() )
    <a href="https://wa.me/{{Func::phoneOnlyNumber($wagon->user->whatsapp)}}">
        {{$wagon->user->whatsapp}}
    </a>
    @else
    <a href="/login">
        *******
    </a>
    @endif

</li>
@endif