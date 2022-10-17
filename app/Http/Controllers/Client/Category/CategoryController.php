<?php

namespace App\Http\Controllers\Client\Category;

use App\Http\Controllers\Controller;
use App\Models\CategoriesProducts;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Display the specified resource.
     *
     */
    public function show(Category $category)
    {

        return view('client.category.show', [
            'category' => $category,
            'products' => $category->Products()->paginate(24),
        ]);
    }

}
