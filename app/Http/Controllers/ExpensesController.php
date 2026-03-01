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

        $expense = expenses::create([
            'colocation_id' => $membership->colocation_id,
            'category_id' => $request->category_id,
            'created_by' => $request->created_by,
            'title' => $request->description,
            'description' => $request->description,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        $colocation = $membership->colocation;
        $activeMembers = $colocation->activeMembers;
        $memberCount = $activeMembers->count();
        $amountPerPerson = $request->amount / $memberCount;

        $settlements = [];
        foreach ($activeMembers as $member) {
            if ($member->user_id != $request->created_by) {
                $settlement = \App\Models\settlements::create([
                    'expenses_id' => $expense->id,
                    'debtor_id' => $member->user_id,
                    'creditor_id' => $request->created_by,
                    'amount' => $amountPerPerson,
                    'is_paid' => false,
                ]);
                $settlement->load('debtor', 'creditor');
                $settlements[] = $settlement;
            }
        }

        return redirect()->route('dashboard')->with(['success' => 'Expense created successfully!', 'settlements' => $settlements]);
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
