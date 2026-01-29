<x-mail::message>

    Зравствуйте {{ $order->user->name }}<br>
    Вы заказали {{ $order->total_quantity }} вещей<br>
    На сумму {{ $order->total_price }} рублей<br>
    Чтобы провести оплату, нажмите на кнопку ниже
    <x-mail::button :url="$url" color="success">
        Перейти на страницу оплаты
    </x-mail::button>

    С уважением,
    {{ env('APP_NAME') }}
</x-mail::message>
