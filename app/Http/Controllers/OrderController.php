<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Enums\ShippingStatus;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        return view('manager.orders.index');
    }

    /*
     * Create Order
     */
    public function store(OrderRequest $request)
    {
        try {
            DB::beginTransaction();
//            $user = Auth::user();
//            $cart = $user->cart;
            $cart = Auth::user()->cart;

            if ($cart->total_quantity == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Корзина пуста'
                ], 400);
            }

            foreach ($cart->cartItems as $cartItem) {
//                $item = $cartItem->item;
                if ($cartItem->item->quantity < $cartItem->quantity) {
                    return response()->json([
                        'success' => false,
                        'message' => "Товар '{$cartItem->item->name}' нет в наличии. Доступно: {$cartItem->item->quantity}"
                    ], 400);
                }
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_quantity' => $cart->total_quantity,
                'total_price' => $cart->total_price,
                'shipping_status' => ShippingStatus::PENDING,
                'payment_status' => PaymentStatus::PENDING,
                'shipping_address' => $request->validated()['userAddress'],
            ]);

            foreach ($cart->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $cartItem->item_id,
                    'quantity' => $cartItem->quantity,
                    'item_name' => $cartItem->item->name,
                    'item_description' => $cartItem->item->description,
                    'item_image' => $cartItem->item->image,
                ]);

                $item = $cartItem->item;
                $item->quantity -= $cartItem->quantity;
                $item->save();
            }

            $cart->cartItems()->delete();
            $cart->totalPrice();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Заказ успешно создан',
                'order_id' => $order->id,
                // TODO order.show route
                'redirect_url' => route('home.index', $order->id)
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        $user = Auth::user();
        $cart = $user->cart;
        if ($cart->total_quantity == 0) {
            return redirect()->route('cart.show', ['id' => $user->id])
                ->with('error', 'Корзина пуста');
        }

        return redirect()->route('order.store', compact('cart', 'user'));
    }

    public function update(string $id)
    {
        if (!Auth::user()) {
            return view('auth.login');
        }
        $order = Order::findOrFail($id);

        $order['payment_status'] = PaymentStatus::PAID;
        $order->save();

        return redirect()->route('home.index');
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
     */
    public function paymentConfirm(string $id)
    {
        if (!Auth::user()) {
            return view('auth.login');
        }

        $user = Auth::user();
        $order = $user->orders()->where('id', $id)->firstOrFail();
        $order['payment_status'] = PaymentStatus::PAID;
        $order->save();
        return redirect()->route('home.index')->with('info', 'Товар оплачен');
    }

}
