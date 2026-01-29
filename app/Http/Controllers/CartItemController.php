<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddItemToCartRequest;
use App\Http\Requests\CartItemUpdateRequest;
use App\Http\Requests\UpdateItemCartQuantityRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Item;
use GuzzleHttp\Psr7\Response;
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
    public function addItemToCart(AddItemToCartRequest $request, Item $item)
    {
        $cart = Cart::where('user_id', Auth::id())->firstOrCreate();
        $cartItem = $cart->cartItems()->where('item_id', $item['id'])->first();

        // Есть ли товар в магазине
        if ($item['quantity'] < 1 || ($cartItem && $cartItem['quantity'] >= $item['quantity'])) {
            return redirect()->route('item.show', ['item' => $item])
                ->with('OutOfStock', 'Товара нет в наличии');
        }

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem['quantity'] + 1]);
//            dd($cartItem->getItem()->image);
        } else {
            CartItem::create([
//                'name' => $item['name'],
                'item_id' => $item['id'],
                'cart_id' => $cart->id,
                'quantity' => $request['quantity'],
//                'price' => $item['price'],
            ]);
        }

        Log::alert('item добавлен в корзину');
        $cart->totalPrice();

        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    /*
     * Ajax обновить количество товара в корзине
     * TODO requestы нормы
     * TODO выпилить транзы норм json response
     */
    public function updateItemCartQuantity(UpdateItemCartQuantityRequest $request)
    {
        Log::alert('request ', $request->all());
        $cartItem = CartItem::findOrFail($request['id']);
        $cart = $cartItem->cart;

        $temp = $cartItem->quantity + $request['change'];

        if ($temp > $cartItem->item->quantity) {
            return $this->updateItemCartResponse(false,
                'Количество товара в корзине не может превышать количество товара в "магазине', 405);
        }

        if ($temp < 1) {
            $cartItem->delete();
            $cart->totalPrice();
            return $this->updateItemCartResponse(true, 'Товар был удален из корзины', 200);
        }

        $cartItem->update(['quantity' => $temp]);
        $cart->totalPrice();

        return back()->with('message', 'Товар обновлен');
//        return $this->updateItemCartResponse(true, 'Товар обновлен', 200);
//        $cartItem = CartItem::findOrFail($request['id']);
//        $cart = $cartItem->cart;

//            $change = $request->sign == 'increase' ? 1 : -1;
//            $cartItem->quantity += $change;
//
//            if ($cartItem['quantity'] > $cartItem->item->quantity) {
//                return response()->json(([
//                    'success' => false,
//                    'message' => 'Количество товара в корзине не может превышать количество товара в "магазине"'
//                ]), 405);
//            }
//
//            if ($change === -1 && $cartItem->quantity < 1) {
//                $cartItem->delete();
//                $cart->totalPrice();
//                return response()->json([
//                    'success' => true,
//                    'message' => 'Товар был удален из корзины'
//                ], 200);
//            }
//
//            $cartItem->save();
//            //TODO
//            $cart = $cartItem->cart;
////            Log::alert('cart ' . $cart);
//
//            $cart->totalPrice();
////            Log::alert('cart ' . $cart->total_price);
//
//            return response()->json([
//                'success' => true,
//                'message' => 'Товар обновлен'
//            ]);
//        }
//        catch (Throwable $e) {
//            return response()->json([
//                'success' => false,
//                'message' => $e->getMessage(),
//                ], 500);
//}
    }

    /*
     * убрать товар из корзины
     */
    public function removeItemFromCart(int $id)
    {
        try {

            $cartItem = CartItem::findOrFail($id);
            $cartItem->delete();
            $cartItem->cart->totalPrice();

            return response()->json([
                'success' => true,
                'message' => 'Товар убран из корзины'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateItemCartResponse($success, $message, $status)
    {
        return response()->json(['success' => $success, 'message' => $message], $status);
    }
}
