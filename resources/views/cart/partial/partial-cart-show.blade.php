<div id="cart-partial">
    @if($cart->total_quantity > 0)
        <div class="container" id="cart-{{$cart->id}}">
            <div style="width: 70%; line-height: 35px; display: inline-block; float: left">
                <table id="table" class="table" style="text-align: center; vertical-align: middle;">
                    <thead>
                    <tr>
                        <th>Изображение</th>
                        <th>Название</th>
                        <th></th>
                        <th>Количество</th>
                        <th></th>
                        <th>Цена</th>
                        <th>Общая цена</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
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
                                {{ $cartItem->item->price }} руб.
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <span id="price_subtotal{{ $cartItem->id }}">{{ $cartItem->getSubtotal() }} руб.</span>
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
                <div id="cart-item-error"></div>

            </div>
            <div id="total-{{ $cartItem->id}}" style="width: 25%; float: right; display: inline-block;
                     border-radius: 10px; border: 1px solid darkgrey;
                     box-shadow: 5px 10px 5px lightgrey; padding: 10px; text-align: center;">
                <div class="sidebox widget">
                    <h4>Итоги заказа</h4>
                    <p>Всего товаров: <span id="cart-total-quantity">{{$cart->total_quantity}}</span></p>
                    <p>Общая сумма: <span id="cart-total-price">{{$cart->total_price}}</span> руб.</p>
                    <label>
                        <h4>Ваш Адрес</h4>
                        <input id="user_address" type="text" placeholder="Ваш адрес" name="address"
                               value="{{old('address')}}" style="width: 200px"> <br>
                        {{--error - success message--}}
                        <span id="address-error" class="text-danger"></span>
                    </label>
                </div>
                <button type="button" id="btn-checkout" class="btn btn-success" style="width: 200px; height: auto">
                    Оформить заказ
                </button>
                <button type="button" id="btn-delete-all" class="btn btn-red"
                        data-cart-id="{{ $cart['id'] }}" style="width: 200px; height: auto">Очистить корзину
                </button>
            </div>
        </div>
    @else
        <div id="is-empty" class="text-center py-5">
            <h3>Корзина пуста</h3>
        </div>
    @endif
</div>


