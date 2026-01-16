<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $cart = $user->cart;
        if ($cart->total_quantity == 0) {
            return redirect()->route('cart.show', ['id' => $user->id])
                ->with('error', 'Корзина пуста');
        }
        dd($cart);

        return view('order.store', compact('cart', 'user'));
    }

    public function store(Request $request)
    {

        try {
            $user = Auth::user();
            $cart = $user->cart;

            if ($cart->total_quantity == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Корзина пуста'
                ], 400);
            }

            foreach ($cart->cartItems as $cartItem) {
                $item = $cartItem->item;
                if ($item->quantity < $cartItem->quantity) {
                    return response()->json([
                        'success' => false,
                        'message' => "Товар '{$item->name}' {$item->quantity}"
                    ], 400);
                }
            }

            Log::alert($user->id);

            $order = Order::create([
                'user_id' => $user->id,
                'total_quantity' => $cart->total_quantity,
                'total_price' => $cart->total_price,
                'shipping_address' => 'dsads',
            ]);
            Log::alert('orderId' . $order->id);

            foreach ($cart->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $cartItem->item_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'item_name' => $cartItem->item->name,
                    'item_description' => $cartItem->item->description ?? '',
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
//                'redirect_url' => route('order.show', $order->id)
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }



}
