<?php

namespace App\Http\Controllers;

use App\Models\colocations;
use App\Models\memberships;
use Illuminate\Http\Request;

class ColocationsController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        return view('colocations.create');        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $colocation = colocations::create([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'owner_id' => auth()->id(),
            'status' => 'active',
        ]);

        memberships::create([
            'user_id' => auth()->id(),
            'colocation_id' => $colocation->id,
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Colocation created successfully!');
    }

    public function show(colocations $colocations)
    {
    }

    public function edit(colocations $colocations)
    {
    }

    public function update(Request $request, colocations $colocations)
    {
    }

    public function destroy(colocations $colocations)
    {
    }
}
