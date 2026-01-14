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

        if ($item['quantity'] < 1) {
            return;
        }
        $user = Auth::user();

        $cart = $user->getCart();


        $cartItem = $cart->cartItems()->where('item_id', $item['id'])->first();


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
    public function increaseItemCartQuantity(Request $request, int $id)
    {
        dd($request);
        try {

        $cartItem = CartItem::findOrFail($id);
        $cartItem['quantity'] += 1;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'message' => 'Cart item increased',

        ]);
        }
        catch (Exception $e) {}
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }

    public function decreaseItemCartQuantity(Request $request, Item $item): void
    {

    }

    public function removeItemFromCart(int $user, Item $item): void {

    }

    public function removeAllItemsFromCart(int $user, Item $item): void {

    }

}
