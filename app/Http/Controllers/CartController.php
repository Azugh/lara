<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function show(Request $request, $user = null)
    {
        $user = User::findOrFail($user);
//        dd($user);
        $cart = $user->getCart();

        return view('cart.cart-show', ["cart" => $cart]);
    }


    public function create()
    {

    }

    public function removeAllItemsFromCart(int $id)
    {

        try {
            DB::beginTransaction();
            $cart = Cart::findOrFail($id);
            foreach ($cart->cartItems as $cartItem) {
                $cartItem->delete();
            }

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

    public function sendResponse(bool   $status = false,
                                 string $message = '',
                                 int    $quantity = 0,
                                 float  $item_total = 0.0,
                                 float  $cart_total_price = 0.0,
                                 int    $cart_total_quantity = 0,
                                 int    $statusCode)
    {

        return new JsonResponse([
            'success' => $status,
            'quantity' => $quantity,
            'item_total' => $item_total,
            'cart_total_price' => $cart_total_price,
            'cart_total_quantity' => $cart_total_quantity,
        ], $statusCode);
    }
}
