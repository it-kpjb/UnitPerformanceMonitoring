<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categoryes = Category::all();
        $category = Category::all();

        return view('layouts.admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Category::create($request->all());

        return redirect()->route('category.index')->with('success', '<div class="alert alert-primary" role="alert">
        <span class="fe fe-alert-circle fe-16 mr-2"></span> Add Successfully! </div>');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('layouts.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|unique:categories,slug,' . $category->id,
        ]);

        $category->update($request->all());

        return redirect()->route('category.index')->with('success', '<div class="alert alert-success" role="alert">
        <span class="fe fe-alert-octagon fe-16 mr-2"></span> Update Succesfully </div>');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success', '<div class="alert alert-danger" role="alert" >
        <span class="fe fe-minus-circle fe-16 mr-2"></span> Delete Successfully! </div>');
    }

    public function checkSlug(Request $request)
    {
        if (!$request->has('name') || empty($request->name)) {
            return response()->json(['error' => 'Name is required'], 400);
        }
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }
}
