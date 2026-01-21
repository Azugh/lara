<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;
use Throwable;

class CartItemController extends Controller
{
    /*
     * добавить товар в корзину
     */
    public function addItemToCart(Request $request, Item $item)
    {

        $user = Auth::user();
        $cart = $user->getCart();
        $cartItem = $cart->cartItems()->where('item_id', $item['id'])->first();

        // Есть ли товар в магазине
        if ($item['quantity'] < 1 || ($cartItem && $cartItem['quantity'] >= $item['quantity'])) {
            return redirect()->route('item.show', ['item' => $item])
                ->with('Error', 'Нет товара в наличии');
        }

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem['quantity'] + 1]);
//            dd($cartItem->getItem()->image);
        } else {
            CartItem::create([
                'name' => $item['name'],
                'item_id' => $item['id'],
                'cart_id' => $cart->id,
                'quantity' => 1,
                'price' => $item['price'],
            ]);
        }

        $cart->totalPrice();

        return redirect()->route('item.show', ['item' => $item])
            ->with('Info', 'Товар добавлен в корзину');
    }

    /*
     * Ajax обновить количество товара в корзине
     */
    public function updateItemCartQuantity($id, $sign) {

        try {
            DB::beginTransaction();
            $cartItem = CartItem::find($id);

            if ($sign == 'increase') {
                $cartItem->quantity += 1;
            }
            elseif ($sign == 'decrease') {
                $cartItem->quantity -= 1;
            }
            else {
                return response()->json([
                    'success' => false,
                    'message' => 'Что ты отправил?'
                ]);
            }
            if ($cartItem['quantity'] > $cartItem->item->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Больше товара нет'
                ], 405);
            }
            $cartItem->save();

            $cart = $cartItem->cart;
            Log::alert('cart ' . $cart);

            $cart->totalPrice();
            Log::alert('cart ' . $cart->total_price);

            DB::commit();
            return response()->json([
                'success' => true,
                'quantity' => $cartItem->quantity,
                'item_total' => $cartItem->quantity * $cartItem->price,
                'cart_total_price' => $cart->total_price,
                'cart_total_quantity' => $cart->total_quantity,
                'price_subtotal' => $cartItem->getSubtotal(),
            ]);
        }
        catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                ], 500);
}
    }
    /*
     * увеличить количество товаров в корзине на 1
     * TODO DRY
     */
//    public function increaseItemCartQuantity(Request $request, int $id): JsonResponse
//    {
////        updateItemCartQuantity($id, 'increase');
//        try {
//            DB::beginTransaction();
//            $cartItem = CartItem::findOrFail($id);
//
//            $cartItem['quantity'] += 1;
//            if ($cartItem['quantity'] > $cartItem->item->quantity) {
////                return $this->sendResponse(status: false, message: '405', statusCode: 405);
//                return response()->json([
//                    'success' => false,
//                    'message' => 'Больше товара нет'
//                ], 405);
//            }
//            $cartItem->save();
//
//            $cart = $cartItem->cart;
//            Log::alert('cart ' . $cart);
//
//            $cart->totalPrice();
//            Log::alert('cart ' . $cart->total_price);
//
//            DB::commit();
//            return response()->json([
//                'success' => true,
//                'quantity' => $cartItem->quantity,
//                'item_total' => $cartItem->quantity * $cartItem->price,
//                'cart_total_price' => $cart->total_price,
//                'cart_total_quantity' => $cart->total_quantity,
//                'price_subtotal' => $cartItem->getSubtotal(),
//            ]);
//        } catch (Exception $e) {
//            DB::rollBack();
//            return response()->json([
//                'success' => false,
//                'message' => $e->getMessage(),
//            ], 500);
//        } catch (Throwable $e) {
//            DB::rollBack();
//            return response()->json([
//                'success' => false,
//                'message' => $e->getMessage(),
//            ], 500);
//        }
//    }
//
//    /*
//     * уменьшить количество товаров в корзине на 1
//     */
//    public function decreaseItemCartQuantity(Request $request, int $id)
//    {
//        try {
//
//            DB::beginTransaction();
//            $cartItem = CartItem::findOrFail($id);
//            $cart = $cartItem->cart;
//            $cartItem['quantity'] -= 1;
//            if ($cartItem['quantity'] < 1) {
//                $cartItem->delete();
//                $cart->totalPrice();
//                return response()->json([
//                    'success' => true,
//                    'quantity' => $cartItem->quantity,
//                    'item_total' => $cartItem->quantity * $cartItem->price,
//                    'cart_total_price' => $cart->total_price,
//                    'cart_total_quantity' => $cart->total_quantity,
//                    'price_subtotal' => $cartItem->getSubtotal(),
//                ]);
//            }
//            $cartItem->save();
//            $cart->totalPrice();
//
//            DB::commit();
//            return response()->json([
//                'success' => true,
//                'quantity' => $cartItem->quantity,
//                'item_total' => $cartItem->quantity * $cartItem->price,
//                'cart_total_price' => $cart->total_price,
//                'cart_total_quantity' => $cart->total_quantity,
//                'price_subtotal' => $cartItem->getSubtotal(),
//
//            ]);
//
//        } catch (Exception $e) {
//            DB::rollBack();
//            return response()->json([
//                'success' => false,
//                'message' => $e->getMessage(),
//            ], 500);
//        } catch (Throwable $e) {
//            DB::rollBack();
//        }
//    }

    /*
     * убрать товар из корзины
     */
    public function removeItemFromCart(int $id)
    {
        try {
            DB::beginTransaction();

            $cartItem = CartItem::findOrFail($id);
            $cart = $cartItem->cart;
            $cartItem->delete();
            $cart->totalPrice();

            DB::commit();
            return response()->json([
                'success' => true,
                'cart_total_price' => $cart->total_price,
                'cart_total_quantity' => $cart->total_quantity,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
