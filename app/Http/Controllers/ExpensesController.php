<?php

namespace App\Http\Controllers;

use App\Models\expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        $membership = \App\Models\memberships::where('user_id', \Auth::id())->whereNull('left_at')->first();
        $colocation = $membership->colocation;
        $categories = $colocation->categories;
        $members = $colocation->activeMembers;
        return view('expenses.create', compact('categories', 'members'));
    }

    public function store(Request $request)
    {
        $membership = \App\Models\memberships::where('user_id', \Auth::id())
            ->whereNull('left_at')
            ->first();

        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'created_by' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        expenses::create([
            'colocation_id' => $membership->colocation_id,
            'category_id' => $request->category_id,
            'created_by' => $request->created_by,
            'title' => $request->description,
            'description' => $request->description,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Expense created successfully!');
    }

    public function show(expenses $expenses)
    {
    }

    public function edit(expenses $expenses)
    {
    }

    public function update(Request $request, expenses $expenses)
    {
    }

    public function destroy(expenses $expenses)
    {
    }
}
