@component(mail::mes)
<h1>
    Здравствуйте {{$user->name}}
</h1>

<h1>
    Ваш пароль {{$password}}
</h1>

@component('mail::button', ['url' => route('email.login', $user)])
    Подтвердить пароль
@endcomponent

<form method="POST" action="{{route('email.login', $user)}}">
    @csrf
    <button type="submit">Подтвердить пароль</button>
</form>
