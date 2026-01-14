@extends('layout.index')
@section('title', 'Корзина')

@section('main')
    <div class="main-content" style="padding-top: 80px; margin-top: 40px;">
        <div class="container">
            <h1>Корзина</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('home.index') }}" class="btn btn-primary mb-3">Вернуться на главную</a>

            <div class="container inline">
                <div style="width: 70%; line-height: 35px; display: inline-block; float: left">
                    @if($cart->total_quantity > 0)
            <table class="table">
                <thead>
                <tr>

                </tr>
                </thead>
                <tbody>
                @foreach($cart->cartItems as $cartItem)
                <tr>
                    <td>
                        <img src="{{ $cartItem->item->image }}" alt="">
                    </td>
                    <td>
                        {{$cartItem->item->name}}
                    </td>
                    <td>
                    <button class="budicon-arrow-left-1"></button>
                    </td>
                    <td>
                        {{$cartItem->quantity}}
                    </td>
                    <td>
                        <button class="btn-increase budicon-arrow-right-1"
                                data-cart-item-id="{{ $cartItem['id'] }}"></button>
                    </td>
                    <td>
                        {{$cartItem->item->price}}
                    </td>
                    <td>
                        <button class="budicon-cancel-1">Удалить</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
                </div>
                    <div style="width: 25%; float: right; display: inline-block;
                     border-radius: 10px; border: 1px solid darkgrey;
                      box-shadow: 5px 10px 5px lightgrey; padding: 10px">
                        <div class="sidebox widget">
                            Всего к оплате {{$cart->total_price}}
                            <br>
                            Всего товаров в корзине {{$cart->total_quantity}}
                            <br>
                            <a href="{{ route('home.index') }}" class="btn btn-primary mb-3">Поплата</a>
                        </div>
                    </div>
                @else
                    Корзина пуста
                @endif
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $(document).on('click', '.btn-increase', function() {
                const cartItemId = $(this).data('cart-item-id')
                $.ajax({
                    url: '{{ route("cart.increase", ":id") }}'.replace(':id', cartItemId),
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            alert('TRUE' + ' ' + cartItemId);
                        }
                    },
                    error: function (xhr) {
                        alert('FALSE' + ' ' + cartItemId);
                    }
                })
            });
        });
    </script>

@endsection
