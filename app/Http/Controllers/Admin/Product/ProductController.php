<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query();

        if (request('search')) {
            $keyword = trim(request('search'));
            $products->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%")
                ->orWhere('inventory', 'LIKE', "%{$keyword}%")
                ->orWhere('view_count', 'LIKE', "%{$keyword}%");
        }

        if (request('sorting')) {
            $sort = request('sorting');
            switch ($sort) {
                case 'desc':
                    $products->orderby('created_at', 'desc');
                    break;
                case 'asc':
                    $products->orderby('created_at', 'asc');
                    break;
                case 'az':
                    $products->orderby('title', 'asc');
                    break;
                case 'za':
                    $products->orderby('tile', 'desc');
                    break;

                default:
                    # code...
                    break;
            }
        }

        // Counting Related Models
        $products = $products->withCount('comments')->paginate(10);
        return view('admin.product.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::all();
        $values = AttributeValue::all();
        return view('admin.product.create', compact(['categories', 'attributes', 'values']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'title' => ['required', 'unique:products,title'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'inventory' => ['required', 'numeric'],
            'categories' => ['required'],
            'attributes' => ['array'],
            'image' => ['required', 'image', 'max:500'],
        ]);

        // $data['user_id'] = auth()->user()->id;
        // Product::create($data);

        // Upload File
        $destination_file = '/images/products/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
        $image = $data['image'];
        $image->move(\public_path($destination_file), $image->getClientOriginalName());

        $data['image'] = $destination_file . $image->getClientOriginalName();

        $product = auth()->user()->products()->create($data);
        $product->categories()->attach($data['categories']);

        if (isset($data['attributes'])) {

            # collect(): Chang an array to collection
            $attributes = collect($data['attributes']);
            $attributes->each(function ($item) use ($product) {
                if (is_null($item['value']) || is_null($item['name'])) {
                    return;
                }
                $att = Attribute::firstOrCreate([
                    'name' => $item['name'],
                ]);

                # Use Relation between Attribut Model and AtrributeValue Model.
                // $val = AttributeValue::firstOrCreate([
                //     'attribute_id' => $att->id,
                //     'value' => $item['value']
                // ]);

                $val = $att->values()->firstOrCreate([
                    'value' => $item['value'],
                ]);

                $product->attributes()->attach($att->id, ['value_id' => $val->id]);
            });

        }

        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $gallery = $product->gallery()->get();
        return view('admin.product.show', compact('product','gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => ['required', 'unique:products,title,' . $product->id],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'inventory' => ['required', 'numeric'],
            'categories' => ['required', 'exists:categories,id'],
        ]);

        // $request->file('image') == $request['image']

        //Upload File
        if (isset($request['image'])) {

            $request->validate([
                'image' => ['required', 'image', 'max:500'],
            ]);

            if (File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $destination_file = '/images/products/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
            $image = $request['image'];
            $image->move(\public_path($destination_file), $image->getClientOriginalName());

            $data['image'] = $destination_file . $image->getClientOriginalName();
        }

        $product->update($data);
        $product->categories()->sync($data['categories']);

        \session('success', 'Product Edited.');

        return \redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        session('success', 'Product Deleted.');

        return redirect(route('product.index'));
    }
}
