<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('posts')->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.index');
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
            'name' => 'required|max:255|unique:categories',
        ]);

        $categories = new Category();

        $categories->name = $request->name;
        $categories->slug = Str::slug($categories->name, '-');

        $categories->save();

        Toastr::success('Category created successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories',
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($category->name, '-');

        $category->save();

        Toastr::success('Category updated successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $categories = Category::with('posts')
            ->where('id', $category->id)
            ->first();

        if (count($categories->posts) > 0) {
            Toastr::warning('Sorry, this category has post', '', ["positionClass" => "toast-top-right"]);
            return redirect()->route('category.index');
        }

        Toastr::success('Category delete successful', '', ["positionClass" => "toast-top-right"]);
        $category->delete();
        return redirect()->route('category.index');
    }
}
