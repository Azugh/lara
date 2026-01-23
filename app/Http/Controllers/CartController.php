<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

//TODO Make guests be able to buy stuff
class CartController extends Controller
{
    //

    public function index()
    {
//        $carts = DB::table('carts')->latest('created_at')->get();
        $carts = Cart::with('cartItems')->get();
        return view('admin.cart.carts', ["carts" => $carts]);
    }

    public function show(Request $request)
    {
//        $user = Auth::user()->with('cart.cartItems')->findOrFail($id);
//        $user = User::with('cart.cartItems')->findOrFail($id);
//        $user = User::findOrFail($id);
//        dd($user);
//        $cart = $user->cart;
        Log::alert('cart.show ' . $request);
//        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
//        } else {
//            $cart = Cart::firstOrCreate(['session_id' => session()->getId()]);
//        }
//
//        $cart->load('cartItems');

        $cart->load('cartItems.item');
        return view('cart.cart-show', compact(['cart']));
    }

    public function partial($id)
    {

        return view('cart.partial.partial-cart-show', ["cart" => Cart::findOrFail($id)])->render();

    }

    public function create()
    {

    }

    /*
     * очищение корзины
     */
    public function removeAllItemsFromCart(int $id)
    {

        try {
            $cart = Cart::with('cartItems')->findOrFail($id);
            $cart->cartItems()->delete();
//            $cart = Cart::findOrFail($id);
//            foreach ($cart->cartItems as $cartItem) {
//                $cartItem->delete();
//            }

            $cart->total_price = 0;
            $cart->total_quantity = 0;
            $cart->save();


            return response()->json([
                'success' => true,
                'cart_total_price' => 0,
                'cart_total_quantity' => 0,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
            ]);
        }
    }

}
