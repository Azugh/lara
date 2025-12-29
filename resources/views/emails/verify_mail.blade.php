<x-mail::message>

Зравствуйте {{ $user['name'] }}

Ваш пароль {{ $userPassword }}

<x-mail::button :url="$url" color="success">
Подтвердить почту
</x-mail::button>

С уважением,<br>
{{ env('APP_NAME') }}
</x-mail::message>
