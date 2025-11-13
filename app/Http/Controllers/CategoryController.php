<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Categories';
        $menu_active = 'categories';
        $categories = Category::orderBy('created_at', 'desc');

        if (!empty($request->search)) {
            $categories = $categories->where('title', 'ilike', '%' . $request->search . '%');
        }

        $categories = $categories->paginate(10);

        return view('master-data.category.index', compact('title', 'categories', 'menu_active'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Category';
        return view('master-data.category.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
        ]);

        Category::create($validatedData);

        return redirect()->route('categories.index')->withSuccess(['Category created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $title = 'Edit Category';
        return view('master-data.category.edit', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'title' => 'required',
        ]);

        $category->update($validatedData);
        return redirect()->route('categories.index')->withSuccess(['Category updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->withSuccess(['Category deleted successfully.']);
    }
}
