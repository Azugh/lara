@extends('layout.index')
@section('title', 'Корзина')

@section('main')
    <div class="main-content" style="padding-top: 80px; margin-top: 40px;">
        <div class="container">
            <h1>Корзина</h1>

            <meta name="csrf-token" content="{{ csrf_token() }}">

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
                <tbody id="cart-{{$cart->id}}">
                @foreach($cart->cartItems as $cartItem)
                <tr id="cart-item-row-{{ $cartItem->id }}">
                    <td>
                        <img src="{{ $cartItem->item->image }}" alt="">
                    </td>
                    <td>
                        {{$cartItem->item->name}}
                    </td>
                    <td>
                        <button class="btn-decrease budicon-arrow-left-1"
                                data-cart-item-id="{{ $cartItem['id'] }}"></button>
                    </td>
                    <td>
                        <span id="quantity{{ $cartItem->id }}">{{ $cartItem->quantity }}</span>
                    </td>
                    <td>
                        <button class="btn-increase budicon-arrow-right-1 btn-"
                                data-cart-item-id="{{ $cartItem['id'] }}"></button>
                    </td>
                    <td>
                        {{$cartItem->item->price}}
                    </td>
{{--                    <td>--}}
{{--                        <span id="item-total{{ $cartItem['id'] }}"></span>--}}
{{--                    </td>--}}
                    <td>
                        <button class="btn-remove budicon-cancel-1"
                                data-cart-item-id="{{ $cartItem['id'] }}">Удалить</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
                </div>
                    <div   id="total-{{ $cartItem->id }}" style="width: 25%; float: right; display: inline-block;
                     border-radius: 10px; border: 1px solid darkgrey;
                      box-shadow: 5px 10px 5px lightgrey; padding: 10px" >
                        <div class="sidebox widget">
                            Всего к оплате <span id="cart-total-price">{{$cart->total_price}}</span>
                            <br>
                            Всего товаров в корзине <span id="cart-total-quantity">{{$cart->total_quantity}}</span>
                            <br>
                            <button type="button" id="btn-checkout" class="btn btn-primary mb-3">Поплата</button>
                            <button type="button" id="btn-delete-all" class="btn btn-primary mb-3"
                            data-cart-id="{{ $cart['id'] }}">очистить корзину</button>
                        </div>
                    </div>
                @else
                    <span>Корзина пуста</span>
                @endif
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            function updateCartSummary(data) {
                $('#cart-total-quantity').text(data.cart_total_quantity);
                $('#cart-total-price').text(data.cart_total_price);
            }

            function updateItemRow(cartItemId, data) {
                $('#quantity' + cartItemId).text(data.quantity);
                $('#item-total' + cartItemId).text(data.item_total)
                // const span = document.getElementById('item-total' + cartItemId);
                // span.innerHTML = data.item_total;
            }

            $(document).on('click', '#btn-delete-all', function () {
                const cartId = $(this).data('cart-id');

                if ($('#cart-total-quantity').text() === 0) {
                    alert('Корзина пуста');
                    return;
                }
                $.ajax({
                    url: '{{ route("cart.delete", ':id') }}'.replace(':id', cartId),
                    type: 'DELETE',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        _token: csrfToken
                    },

                    success: function (response) {
                        updateCartSummary({
                            cart_total_quantity: response.cart_total_quantity,
                            cart_total_price: response.cart_total_price
                        })
                        $('#cart-' + cartId).fadeOut(300, function() {
                            $(this).remove();
                        });
                        $('#total-' + cartId).fadeOut(300, function () {
                            $(this).remove();
                        });
                    },
                    error: function (response) {
                        alert('FAILURE')
                    }
                })
            });
            $(document).on('click', '#btn-checkout', function() {
                if ($('#cart-total-quantity').text() === 0) {
                    alert('Корзина пуста');
                    return;
                }

                $.ajax({
                    url: '{{ route("order.store") }}',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Заказ успешно оформлен! Номер заказа: ' + response.order_id);
{{--                            fetch("{{ route("home.index") }}")--}}
                            window.location.href = response.redirect_url || '{{ route("home.index") }}';
                        } else {
                            alert('Ошибка: ' + response.message);
                        }
                    },
                    error: function(xhr, response) {

                        alert(response.status);
                    }
                });
            });

            $(document).on('click', '.btn-remove', function() {
                const cartItemId = $(this).data('cart-item-id');

                $.ajax({
                    url: '{{ route("cart.remove", ":id") }}'.replace(':id', cartItemId),
                    type: 'DELETE',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        _token: csrfToken
                    },
                    success: function(response) {


                            $('#cart-item-row-' + cartItemId).fadeOut(300, function() {
                                $(this).remove();
                            });
                            if (response.cart_total_quantity === 0) {
                                $('#total-' + cartItemId).fadeOut(300, function () {
                                    $(this).remove();
                                });
                            }
                            updateCartSummary({
                                cart_total_quantity: response.cart_total_quantity,
                                cart_total_price: response.cart_total_price
                            });
                    },
                    error: function(xhr) {
                        alert(xhr);
                    }
                });
            });

            $(document).on('click', '.btn-increase', function() {
                const cartItemId = $(this).data('cart-item-id')
                $.ajax({
                    url: '{{ route("cart.increase", ":id") }}'.replace(':id', cartItemId),
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                      _token: csrfToken
                    },
                    success: function (response) {
                        if (response.success) {
                            // alert('TRUE' + ' ' + cartItemId);
                            updateItemRow(cartItemId, {
                                quantity: response.quantity,
                                item_total: response.item_total
                            });

                            updateCartSummary({
                                cart_total_quantity: response.cart_total_quantity,
                                cart_total_price: response.cart_total_price
                            })
                        }
                    },
                    error: function (response) {
                        let msg;
                        switch (response.status) {
                            case 405:
                                msg = '405';
                                break;
                            default:
                                msg = 'FALSE';
                                break;
                        }
                        alert(msg + ' ' + cartItemId);
                    }
                })
            });

            $(document).on('click', '.btn-decrease', function() {
                const cartItemId = $(this).data('cart-item-id')
                $.ajax({
                    url: '{{ route("cart.decrease", ":id") }}'.replace(':id', cartItemId),
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        _token: csrfToken
                    },
                    success: function (response) {

                        if (response.quantity === 0) {
                            $('#cart-item-row-' + cartItemId).fadeOut(300, function() {
                                $(this).remove();
                            });

                            if(response.cart_total_quantity === 0) {
                                $('#total-' + cartItemId).fadeOut(300, function() {
                                    $(this).remove();
                                });
                            }
                        }
                            // alert('TRUE' + ' ' + cartItemId);
                        updateItemRow(cartItemId, {
                            quantity: response.quantity,
                            item_total: response.item_total
                        });

                        updateCartSummary({
                            cart_total_quantity: response.cart_total_quantity,
                            cart_total_price: response.cart_total_price
                        })
                    },
                    error: function (response) {
                        let msg;
                        switch (response.status) {
                            case 405:
                                msg = '405';
                                break;
                            default:
                                msg = 'FALSE';
                                break;
                        }
                        alert(msg);
                    }
                })
            });
        });
    </script>

@endsection
