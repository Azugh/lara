<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class CartItemController extends Controller
{
    //

    public function addItemToCart(Request $request, Item $item): void
    {

        $user = Auth::user();
        $cart = $user->getCart();
        $cartItem = $cart->cartItems()->where('item_id', $item['id'])->first();

        if ($item['quantity'] < 1 || ($cartItem && $cartItem['quantity'] >= $item['quantity'])) {
            return;
        }

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem['quantity'] + 1]);
            dd($cartItem->getItem()->image);
        } else {
            CartItem::create([
                'item_id' => $item['id'],
                'cart_id' => $cart->id,
                'quantity' => 1,
                'price' => $item['price'],
            ]);
        }

        $cart->totalPrice();
    }

    public function increaseItemCartQuantity(Request $request, int $id): JsonResponse
    {
        try {
            $cartItem = CartItem::findOrFail($id);

            $cartItem['quantity'] += 1;
            if ($cartItem['quantity'] > $cartItem->item->quantity) {
//                return $this->sendResponse(status: false, message: '405', statusCode: 405);
                return response()->json([
                    'success' => false,
                    'message' => '405'
                ], 405);
            }
            $cartItem->save();

            $cart = $cartItem->cart;
            $cart->totalPrice();

            return response()->json([
                'success' => true,
                'quantity' => $cartItem->quantity,
                'item_total' => $cartItem->quantity * $cartItem->price,
                'cart_total_price' => $cart->total_price,
                'cart_total_quantity' => $cart->total_quantity,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function decreaseItemCartQuantity(Request $request, int $id)
    {
        try {
            $cartItem = CartItem::findOrFail($id);
            $cart = $cartItem->cart;
            $cartItem['quantity'] -= 1;
            if ($cartItem['quantity'] < 1) {
                $cartItem->delete();
                $cart->totalPrice();
                return response()->json([
                    'success' => true,
                    'quantity' => $cartItem->quantity,
                    'item_total' => $cartItem->quantity * $cartItem->price,
                    'cart_total_price' => $cart->total_price,
                    'cart_total_quantity' => $cart->total_quantity,
                ]);
            }
            $cartItem->save();
            $cart->totalPrice();

            return response()->json([
                'success' => true,
                'quantity' => $cartItem->quantity,
                'item_total' => $cartItem->quantity * $cartItem->price,
                'cart_total_price' => $cart->total_price,
                'cart_total_quantity' => $cart->total_quantity,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function removeItemFromCart(int $id)
    {
        try {
            $cartItem = CartItem::findOrFail($id);
            $cart = $cartItem->cart;
            $cartItem->delete();
            $cart->totalPrice();
            return response()->json([
                'success' => true,
                'cart_total_price' => $cart->total_price,
                'cart_total_quantity' => $cart->total_quantity,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
