<?php

namespace App\Http\Controllers\Client\Product;

use App\Models\Comment;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function shop(Product $product)
    {
        $products = Product::latest()->paginate(12);
        return view('client.product.shop', compact('products'));
    }
    
    public function detail(Product $product)
    {
        return view('client.product.detail',compact('product'));
    }

    public function commentList()
    {
        // $comments = Comment::all();
        return view('client.product.comment');
    }

}
