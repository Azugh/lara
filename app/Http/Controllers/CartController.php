<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

//TODO Make guests be able to buy stuff
class CartController extends Controller
{
    //

    public function index()
    {
//        $carts = DB::table('carts')->latest('created_at')->get();
        $carts = Cart::with('cartItems.items')->get();
        return view('admin.cart.carts', ["carts" => $carts]);
    }

    public function show(Request $request, $id)
    {
//        $user = Auth::user()->with('cart.cartItems')->findOrFail($id);
//        $user = User::with('cart.cartItems')->findOrFail($id);
//        $user = User::findOrFail($id);
//        dd($user);
//        $cart = $user->cart;

        return view('cart.cart-show', ["cart" => Auth::user()->cart]);
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
            DB::beginTransaction();
            $cart = Cart::with('cartItems')->findOrFail($id);
            $cart->cartItems()->delete();
//            $cart = Cart::findOrFail($id);
//            foreach ($cart->cartItems as $cartItem) {
//                $cartItem->delete();
//            }

            $cart->total_price = 0;
            $cart->total_quantity = 0;
            $cart->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'cart_total_price' => 0,
                'cart_total_quantity' => 0,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
            ]);
        }
    }

}
