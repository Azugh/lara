<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Enums\ShippingStatus;
use App\Http\Requests\ChangeShippingStatusRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('user')->where('payment_status', PaymentStatus::PAID->value)->get();
        return view('manager.order.index', compact('orders'));
    }

    /*
     * создание заказа из корзины пользователя
     */
    public function store(OrderRequest $request)
    {
        Log::alert('order request ' . $request);
        try {
            Log::alert('order stored' . $request->cartItems);

//            $user = Auth::user();
//            $cart = $user->cart;

            $cart = Auth::user()->cart;
            Log::alert('request ' . $request->userAddress);

            /*
             * проверка наличия товаров в корзине
             */
            if ($cart->total_quantity == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Корзина пуста'
                ], 400);
            }

            /*
             * проверка наличия товара в "магазине"
             */
            foreach ($cart->cartItems as $cartItem) {
//                $item = $cartItem->item;
                if ($cartItem->item->quantity < $cartItem->quantity) {
                    return response()->json([
                        'success' => false,
                        'message' => "Товар '{$cartItem->item->name}' нет в наличии. Доступно: {$cartItem->item->quantity}"
                    ], 400);
                }
            }

            /*
             * Создание заказа для пользователя
             */
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'total_quantity' => $cart->total_quantity,
                'total_price' => $cart->total_price,
                'shipping_status' => ShippingStatus::PENDING,
                'payment_status' => PaymentStatus::PENDING,
                'shipping_address' => $request->userAddress,
            ]);

            /*
             * заполнение заказа товарами из корзины
             */
            foreach ($cart->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $cartItem->item->id,
                    'quantity' => $cartItem->quantity,
                    'item_name' => $cartItem->item->name,
                ]);

                /*
                 * уменьшение кол-ва товаров в "магазине"
                 * на кол-во товаров в корзине->заказе
                 */
                $cartItem->item->quantity -= $cartItem->quantity;
                $cartItem->item->save();
            }

            /*
             * очистка корзины
             */
            $cart->cartItems()->delete();
            $cart->totalPrice();


            return response()->json([
                'success' => true,
                'message' => 'Заказ успешно создан',
                'order_id' => $order->id,
                // TODO order.show route
                'redirect_url' => route('home.index', $order->id)
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        $user = Auth::user();
        $cart = Auth::user()->cart;
        if ($cart->total_quantity == 0) {
            return redirect()->route('cart.show', ['id' => $user->id])
                ->with('error', 'Корзина пуста');
        }

        return redirect()->route('order.store', compact('cart', 'user'));
    }

//    public function update(Request $request)
//    {
//
//    }

    /*
     * Мэнеджер изменяет статус заказа
     */
    public function updateShippingStatus(ChangeShippingStatusRequest $request, $id)
    {

        $order = Order::find($id);
        /*
         * никаких движений при не оплаченном заказе
         */
        if ($order->payment_status == PaymentStatus::PENDING) {
            Log::alert('Заказ не оплачен' . $order->id);
        }
        $order->shipping_status = $request->shipping_status;
        $order->save();

        return back();
    }


//    public function payment(string $id)
//    {
//        if (!Auth::user()) {
//            return view('auth.login');
//        }
//        $order = Order::findOrFail($id);
//
//        $order['payment_status'] = PaymentStatus::PAID;
//        $order->save();
//
//        return redirect()->route('home.index');
//    }

    /*
     * TODO make view like cart view with only info about order
     * Пользователь в письме подтверждает оплату
     */
    public function paymentConfirm(string $id)
    {
        if (!Auth::user()) {
            return view('auth.login');
        }

//        $user = Auth::user();
        Log::alert('Пользователь сделал покупку ' . Auth::id() . ' ' . Auth::user()->name);

        $order = Auth::user()->orders()->where('id', $id)->firstOrFail();
        $order->payment_status = PaymentStatus::PAID;
        $order->payment_date = Carbon::now();
        $order->save();
        return redirect()->route('home.index')->with('info', 'Товар оплачен');
    }

    public function edit(string $id)
    {
        $order = Order::findOrFail($id);

        return view('manager.order.edit', compact('order'));
    }

}
