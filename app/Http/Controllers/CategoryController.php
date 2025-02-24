<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        $categories = category::whereNull('user_id')->orWhere('user_id', $user)->get();
        return view('pages.category.index', compact(
            'categories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:15',
            // 'cover' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:max_width=16,max_height=16'
        ]);
    
        $category = Category::create($validated);
    
        return response()->json([
            'success' => true,
            'category' => $category
        ]);
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
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,'.$id.'|max:255',
            // 'cover' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:max_width=16,max_height=16'
        ]);
    
        $category = Category::findOrFail($id);
        $category->update($validated);
    
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

    return response()->json(['success' => true]);
    }
}
