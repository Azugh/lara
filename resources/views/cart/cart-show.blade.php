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
                @if($cart->total_quantity > 0)
                    <div class="container">
                        <div style="width: 70%; line-height: 35px; display: inline-block; float: left">
                            <table id="table" class="table" style="text-align: center; vertical-align: middle;">
                                <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">Изображение</th>
                                    <th style="text-align: center; vertical-align: middle;">Название</th>
                                    <th style="text-align: center; vertical-align: middle;"></th>
                                    <th style="text-align: center; vertical-align: middle;">Количество</th>
                                    <th style="text-align: center; vertical-align: middle;"></th>
                                    <th style="text-align: center; vertical-align: middle;">Цена</th>
                                    <th style="text-align: center; vertical-align: middle;">Общая цена</th>
                                    <th style="text-align: center; vertical-align: middle;">Действие</th>
                                </tr>
                                </thead>
                                <tbody id="cart-{{$cart->id}}">
                                @foreach($cart->cartItems as $cartItem)
                                    <tr id="cart-item-row-{{ $cartItem->id }}"
                                        style="text-align: center; vertical-align: middle;">
                                        <td style="text-align: center; vertical-align: middle;">
                                            <img src="{{ $cartItem->item->image }}" alt="{{ $cartItem->item->name }}"
                                                 style="max-width: 100px; max-height: 100px; object-fit: contain;">
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            {{$cartItem->item->name}}
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-decrease budicon-arrow-left-1"
                                                    data-cart-item-id="{{ $cartItem['id'] }}"></button>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <span id="quantity{{ $cartItem->id }}">{{ $cartItem->quantity }}</span>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-increase budicon-arrow-right-1"
                                                    data-cart-item-id="{{ $cartItem['id'] }}"></button>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            {{ $cartItem->price }} руб.
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            {{ $cartItem->getSubtotal() }} руб.
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button class="btn-remove btn btn-danger btn-sm"
                                                    data-cart-item-id="{{ $cartItem['id'] }}">Удалить
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="total-{{ $cartItem->id}}" style="width: 25%; float: right; display: inline-block;
                         border-radius: 10px; border: 1px solid darkgrey;
                         box-shadow: 5px 10px 5px lightgrey; padding: 10px; text-align: center;">
                            <div class="sidebox widget">
                                <h4>Итоги заказа</h4>
                                <p>Всего товаров: <span id="cart-total-quantity">{{$cart->total_quantity}}</span></p>
                                <p>Общая сумма: <span id="cart-total-price">{{$cart->total_price}}</span>руб.</p>
                                <label>
                                    <h4>Ваш Адрес</h4>
                                    <input id="user_address" type="text" placeholder="Ваш адрес" name="address"
                                           value="{{old('address')}}">
                                </label>
                            </div>
                            <button type="button" id="btn-checkout" class="btn btn-success">Оформить заказ</button>
                            <button type="button" id="btn-delete-all" class="btn btn-warning"
                                    data-cart-id="{{ $cart['id'] }}">Очистить корзину
                            </button>
                        </div>
                    </div>
            </div>
            @else
                <div id="is-empty" class="text-center py-5">
                    <h3>Корзина пуста</h3>
                </div>
            @endif
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $(document).ready(function () {
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
                        $('#cart-' + cartId).fadeOut(300, function () {
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

            $(document).on('click', '#btn-checkout', function () {
                if ($('#cart-total-quantity').text() == 0) {
                    alert('Корзина пуста');
                    return;
                }

                var cartItems = [];
                $('.cart-item-row-').each(function () {
                    cartItems.push({
                        product_id: $(this).data('product-id')
                    });
                });

                const userAddress = $('#user_address').val().trim();

                if (!userAddress) {
                    alert('Пожалуйста, введите адрес доставки');
                    return;
                }

                const data = {
                    cartItems: cartItems,
                    userAddress: userAddress
                };

                $.ajax({
                    url: '{{ route("order.store") }}',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        if (response.success) {
                            alert('Заказ успешно оформлен ' + response.order_id);
                            window.location.href = response.redirect_url || '{{ route("home.index") }}';
                        }
                    },
                    error: function (xhr, response) {
                        alert(response.message);
                    }
                });
            });

            $(document).on('click', '.btn-remove', function () {
                const cartItemId = $(this).data('cart-item-id');

                $.ajax({
                    url: '{{ route("cart-item.remove", ":id") }}'.replace(':id', cartItemId),
                    type: 'DELETE',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        _token: csrfToken
                    },
                    success: function (response) {

                        $('#cart-item-row-' + cartItemId).fadeOut(300, function () {
                            $(this).remove();
                        });
                        if (response.cart_total_quantity === 0) {
                            $('#total-' + cartItemId).fadeOut(300, function () {
                                $(this).remove();
                            });
                            $('.table').hide();
                            $('is-empty').show();
                        }
                        updateCartSummary({
                            cart_total_quantity: response.cart_total_quantity,
                            cart_total_price: response.cart_total_price
                        });
                    },
                    error: function (xhr) {
                        alert(xhr);
                    }
                });
            });

            $(document).on('click', '.btn-increase', function () {
                const cartItemId = $(this).data('cart-item-id')
                $.ajax({
                    url: '{{ route("cart-item.increase", ":id") }}'.replace(':id', cartItemId),
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
                            updateItemRow(cartItemId, {
                                quantity: response.quantity,
                                item_total: response.item_total
                            });

                            updateCartSummary({
                                cart_total_quantity: response.cart_total_quantity,
                                cart_total_price:
                                response.cart_total_price
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

            $(document).on('click', '.btn-decrease', function () {
                const cartItemId = $(this).data('cart-item-id')
                $.ajax({
                    url: '{{ route("cart-item.decrease", ":id") }}'.replace(':id', cartItemId),
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
                            $('#cart-item-row-' + cartItemId).fadeOut(300, function () {
                                $(this).remove();
                            });

                            if (response.cart_total_quantity === 0) {
                                $('#total-' + cartItemId).fadeOut(300, function () {
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
