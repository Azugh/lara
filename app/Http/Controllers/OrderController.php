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
use Illuminate\Support\Facades\Log;
use Throwable;

class OrderController extends Controller
{
    /*
     * Create Order
     */
    public function store(OrderRequest $request)
    {

        try {
            DB::beginTransaction();
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

//            Log::alert($user->id);
            // Make new order
            $order = Order::create([
                'user_id' => $user->id,
                'total_quantity' => $cart->total_quantity,
                'total_price' => $cart->total_price,
                'shipping_status' => ShippingStatus::PENDING,
                'payment_status' => PaymentStatus::PENDING,
                'shipping_address' => 'address',
            ]);

//            Log::alert($order->getUser());
//            Log::alert('orderId' . $order->id);

            // Make order items for order
            foreach ($cart->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $cartItem->item_id,
                    'quantity' => $cartItem->quantity,
//                    'price' => $cartItem->price,
                    'item_name' => $cartItem->item->name,
                    'item_description' => $cartItem->item->description ?? '',
                    'item_image' => $cartItem->item->image,
                ]);

//                $item = $cartItem->item;
//                $item->quantity -= $cartItem->quantity;
//                $item->save();
            }

//            $cart->cartItems()->delete();
//            $cart->totalPrice();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Заказ успешно создан',
                'order_id' => $order->id,
//                'redirect_url' => route('order.show', $order->id)
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        } catch (Throwable $e) {
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

        return view('order.store', compact('cart', 'user'));
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

}
