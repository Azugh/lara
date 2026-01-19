<x-mail::message>

Зравствуйте {{ $order->getUser()->name }}
<x-mail::button :url="$url" color="success">
Подтвердить почту
</x-mail::button>

С уважением,
{{ env('APP_NAME') }}
</x-mail::message>
