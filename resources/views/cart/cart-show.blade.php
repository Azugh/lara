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

        let userAddressText = '';

        async function updateCart(userAddressText) {
            const response = await fetch('{{ route("cart.partial", $cart->id ) }}');
            document.getElementById('cart-container').innerHTML = await response.text();
        }

        function errorHandler(data, status) {
            const itemCartError = $('#cart-item-error');

            switch (status) {
                case 405:
                    itemCartError.addClass('alert alert-danger');
                    itemCartError.text(data.message);
                    // itemCartError.innerHTML = '<button type="button" class="close" data-dismiss="alert">x</button>'
                    // alert(data.message);
                    break;
                case 200:
                    itemCartError.addClass('alert alert-success');
                    itemCartError.text(data.message);
                    // itemCartError.innerHTML = '<button type="button" class="close" data-dismiss="alert">x</button>'
                    alert(data.message);
                    break;
                case 422:
                    const userAddress = $('#user_address');
                    const addressError = $('#address-error');
                    userAddress.text(userAddressText);
                    userAddress.css('border-color', 'red');
                    addressError.text(data.errors);
                    break;
            }
        }

        // TODO найти ajax с формами в blade
        // TODO найти замену data(cart-id)
        $(document).ready(function () {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            updateCart()

            $(document).on('click', '#btn-checkout', async function () {
                const form = document.getElementById('order-checkout-form');
                const formData = new FormData(form);

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    await updateCart();
                } else {
                    const data = await response.json()
                    errorHandler(data, response.status);
                }
            });

            $(document).on('click', '#btn-delete-all', async function () {
                const form = document.getElementById('delete-cart-form');
                const formData = new FormData(form);

                if (!confirm('Очистить корзину')) {
                    return
                }

                const response = await fetch(form.action, {
                    method: 'DELETE',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    console.log('Корзина очищена');
                    await updateCart();
                }
            });

            $(document).on('click', '.btn-remove', async function () {
                const form = document.getElementById('delete-cart-item-form');
                const formData = new FormData(form);

                const response = await fetch(form.action, {
                    method: 'DELETE',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

            });

            $(document).on('click', '.btn-increase', async function () {
                const form = document.getElementById('update-form');
                const formData = new FormData(form);

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    await updateCart();
                }
                else {
                    const data = await response.json();
                    errorHandler(data, response.status);
                }
            });

        })
    </script>

@endsection
