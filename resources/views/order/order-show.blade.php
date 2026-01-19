@extends('layout.index')
@section('title', 'Заказ #' . $order->id)

@section('main')
    <div class="main-content" style="padding-top: 80px; margin-top: 40px;">
        <div class="container">
            <h1>Заказ #{{ $order->id }}</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <h5>Информация о заказе</h5>
                </div>
                <div class="card-body">
                    <p>Дата создания: {{ $order->created_at }}</p>
                    <p>Статус доставки: {{ $order->shipping_status }}</p>
                    <p>Статус оплаты: {{ $order->payment_status }}</p>
                    <p>Общее количество: {{ $order->total_quantity }}</p>
                    <p>Общая сумма: {{ $order->total_price }} ₽</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Товары в заказе</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Количество</th>
                            <th>Цена за единицу</th>
                            <th>Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->orderItems as $orderItem)
                            <tr>
                                <td>
                                    @if($orderItem->item_image)
                                        <img src="{{ $orderItem->item_image }}" alt="{{ $orderItem->item_name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                    @endif
                                    {{ $orderItem->item_name }}
                                </td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>{{ $orderItem->price }} ₽</td>
                                <td>{{ $orderItem->price * $orderItem->quantity }} ₽</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <a href="{{ route('home.index') }}" class="btn btn-primary mt-3">Вернуться на главную</a>
            <a href="{{ route('order.index') }}" class="btn btn-secondary mt-3">К списку заказов</a>
        </div>
    </div>
@endsection
