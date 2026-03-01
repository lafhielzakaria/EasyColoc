<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $membership = \App\Models\memberships::where('user_id', \Auth::id())
            ->whereNull('left_at')
            ->first();
        
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('categories')->where(function ($query) use ($membership) {
                    return $query->where('colocation_id', $membership->colocation_id);
                })
            ]
        ]);

        categories::create([
            'colocation_id' => $membership->colocation_id,
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(categories $category)
    {
        $category->load('expenses');
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categories $categories)
    {
        //
    }
}
