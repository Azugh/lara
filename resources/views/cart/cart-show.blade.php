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

            <div id="cart-container">
                @include('cart.partial.partial-cart-show', ['cart' => $cart])
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

        async function updateCart() {
            const response = await fetch('{{ route("cart.partial", $cart->id ) }}');
            const html = await response.text();
            document.getElementById('cart-container').innerHTML = html;
        }


        $(document).ready(function () {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            updateCart()

            $(document).on('click', '#btn-checkout', async function () {
                const cartId = $(this).data('cart-id');
                const userAddress = $('#user_address').val().trim();

                const response = await fetch('{{ route("order.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        userAddress: userAddress
                    }),
                });
                if (response.ok) {
                    console.log('корзина обновлена')
                    await updateCart();
                }
                else {
                    const data = await response.json();
                    if (data.errors.includes('The user address field is required.')) {
                        $('#user_address').css('border-color', 'red');
                        $('#address-error').text('Введите адрес');
                    }
                }
            });

            $(document).on('click', '#btn-delete-all', async function () {
                const cartId = $(this).data('cart-id');
                const response = await fetch('{{ route("cart.delete", ":id") }}'.replace(':id', cartId), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });
                if (response.ok) {
                    console.log('корзина очишена');
                    await updateCart();
                }
            });

            $(document).on('click', '.btn-remove', async function () {
                const cartItemId = $(this).data('cart-item-id');
                const response = await fetch('{{ route("cart-item.remove", ":id") }}'.replace(':id', cartItemId), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });
                if (response.ok) {
                    console.log('Товар удален из корзины');
                    await updateCart();
                }
            });

            $(document).on('click', '.btn-increase', async function () {
                const cartItemId = $(this).data('cart-item-id');
                const response = await fetch('{{ route("cart-item.update-quantity", ":id") }}'.replace(':id', cartItemId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        sign: 'increase',
                    }),
                });
                if (response.ok) {
                    const data = await response.json();
                    await updateCart()
                    // alert(data.message);
                    console.log(data.message);
                }
            })


            $(document).on('click', '.btn-decrease', async function () {
                const cartItemId = $(this).data('cart-item-id');
                const response = await fetch('{{ route("cart-item.update-quantity", ":id") }}'.replace(':id', cartItemId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        sign: 'decrease',
                    }),
                });
                if (response.ok) {
                    const data = await response.json();
                    await updateCart()
                    // alert(data.message);
                    console.log(data.message);
                }
            })
        })
    </script>

@endsection
