<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $imgs = $product->gallery()->latest()->get();
        return view('admin.product.gallery.all', compact('imgs', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.product.gallery.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'images.*.image' => ['required', 'image', 'max:500'],
            'images.*.alt' => ['required', 'string'],
        ]);

        $destination_file = '/images/products/' . now()->year . '/' . now()->month . '/' . now()->day . '/';

        \collect($data['images'])->each(function ($image) use ($product, $destination_file) {
            $image['image']->move(\public_path($destination_file), $image['image']->getClientOriginalName());

            $product->gallery()->create([
                'url' => $destination_file . $image['image']->getClientOriginalName(),
                'alt' => $image['alt'],
            ]);
        });

        return redirect()->route('products.gallery.index', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Gallery $gallery)
    {
        return \view('admin.product.gallery.edit', compact('product', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Gallery $gallery)
    {
        $data = $request->validate([
            'alt' => ['required', 'string'],
        ]);

        if (isset($request['url'])) {
            $request->validate([
                'url' => ['required', 'image', 'max:500'],
            ]);

            if (File::exists(public_path($gallery->url))) {
                File::delete(public_path($gallery->url));
            }

            $destination_file = '/images/products/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
            $image = $request['url'];
            $image->move(\public_path($destination_file), $image->getClientOriginalName());

            $data['url'] = $destination_file . $image->getClientOriginalName();
        }

        $gallery->update($data);

        return redirect()->route('products.gallery.index', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Gallery $gallery)
    {
        $gallery->delete();

        if (File::exists(public_path($gallery->url))) {
            File::delete(public_path($gallery->url));
        }

        return redirect()->route('products.gallery.index', $product);
    }
}
