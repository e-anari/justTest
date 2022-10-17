<?php

namespace App\Http\Controllers\Client;

use App\Helpers\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;

class CartController extends Controller
{

    public function cart()
    {

        $cartList = Cart::all();
        return view('client.cart.cart', compact('cartList'));
    }

    public function addToCart(Product $product)
    {
        Cart::put(
            [
                // 'id' => 1,
                'quantity' => 1,
                'price' => $product->price,
            ],
            $product
        );

        return 'Ok';
    }
}
