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

    public function show()
    {
//        Log::alert('cart.show ' . $request->getContent());
        $cart = Cart::with('cartItems.item')->where('user_id', Auth::id())->first();
        if (!$cart) {
            $cart = Cart::create(['user_id' => Auth::id()]);
            $cart->load('cartItems.item');
        }
        return view('cart.cart-show', compact(['cart']));
    }

    public function partial($id)
    {
        try {
            return view('cart.partial.partial-cart-show', ["cart" => Cart::findOrFail($id)])->render();
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
        }

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
