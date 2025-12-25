<x-guest-layout>
<h1>
    Здравствуйте {{$registerRequest->name}}
</h1>

<h1>
    Ваш пароль {{$password}}
</h1>

<form method="POST" action="{{route('email.login', $registerRequest)}}">
    @csrf
    <x-primary-button type="submit">Подтвердить почту</x-primary-button>
</form>
</x-guest-layout>

