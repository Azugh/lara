<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;
use \Illuminate\Http\JsonResponse;

//TODO Make guests be able to buy stuff
class CartController extends Controller
{
    //

    public function index() {
//        $carts = DB::table('carts')->latest('created_at')->get();
        $carts = Cart::with('cartItems')->get();
        return view('admin.cart.carts', ["carts" => $carts]);
    }

    public function create() {

    }

    public function show(int $user) {
        $user = User::findOrFail($user);
//        dd($user);
        $cart = $user->getCart();

        return view('cart.cart-show', ["cart" => $cart]);
//        dd($cart->getUser());

    }

    /* TODO Requst to CartItemRequest
    *  item exists
     * item quantity > 0
    * cartItem quantity />=/ item quantity
     */

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
        }
        else {
            CartItem::create([
                'item_id' => $item['id'],
                'cart_id' => $cart->id,
                'quantity' => 1,
                'price' => $item['price'],
            ]);
        }

        $cart->totalPrice();
    }

    //TODO ajax
    public function increaseItemCartQuantity(Request $request, int $id): JsonResponse
    {
        try {
            $cartItem = CartItem::findOrFail($id);

            $cartItem['quantity'] += 1;
            if ($cartItem['quantity'] > $cartItem->item->quantity) {
//                return $this->sendResponse(status: false, message: 'Quantity out of stock', statusCode: 405);
                return response()->json([
                    'success' => false,
                    'message' => 'Quantity out of stock'
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

        }
        catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function removeItemFromCart(Request $request, int $id) {
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

    public function removeAllItemsFromCart(int $user, Item $item): void {

    }

    public function sendResponse(bool $status = false,
                                 string $message = '',
                                 int $quantity = 0,
                                 float $item_total = 0.0,
                                 float $cart_total_price = 0.0,
                                 int $cart_total_quantity = 0,
                                 int $statusCode) {

        return new JsonResponse([
            'success' => $status,
            'quantity' => $quantity,
            'item_total' => $item_total,
            'cart_total_price' => $cart_total_price,
            'cart_total_quantity' => $cart_total_quantity,
        ], $statusCode);
    }
}
