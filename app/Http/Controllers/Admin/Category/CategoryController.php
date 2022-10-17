<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query();

        if (request('search')) {
            $keyword = trim(request('search'));
            $categories->where('title', 'LIKE', "%{$keyword}%");
        }

        if (request('sorting')) {
            $sort = request('sorting');
            switch ($sort) {
                case 'desc':
                    $categories->orderby('created_at', 'desc');
                    break;
                case 'asc':
                    $categories->orderby('created_at', 'asc');
                    break;
                case 'az':
                    $categories->orderby('title', 'asc');
                    break;
                case 'za':
                    $categories->orderby('tile', 'desc');
                    break;

                default:
                    # code...
                    break;
            }
        }

        // Counting Related Models
        $categories = $categories->latest()->paginate(10);
        return view('admin.category.index', compact('categories'));

    }

    public function manage()
    {
        $categories = Category::query();
        $allCategories = Category::all();

        $categories = $categories->whereNull('parent_id')->latest()->paginate(10);
        return view('admin.category.manage', compact(['categories', 'allCategories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategories = Category::all();
        return view('admin.category.create', compact('allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:categories'],
            'parent_id' => ['sometimes', 'exists:categories,id', 'nullable'],
        ]);

        $category = auth()->user()->categories()->create([
            'title' => $request->get('title'),
            'parent_id' => $request->get('parent_id'),
        ]);

        // Categoriable::create([
        //     'category_id' => $category->id,
        //     'categoriable_id' => ,
        //     'categoriable_type' => get_class(Product::class),
        // ]);

        return \redirect()->route('category.manage');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $allCategories = Category::all();
        return view('admin.category.edit', compact(['category', 'allCategories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'title' => ['required', 'unique:categories,title,' . $category->id],
            'parent_id' => ['sometimes', 'exists:categories,id', 'nullable'],
        ]);

        $category->update($data);

        return redirect()->route('category.manage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.manage');
    }
}
