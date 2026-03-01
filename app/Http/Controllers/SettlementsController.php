<?php

namespace App\Http\Controllers;

use App\Models\settlements;
use Illuminate\Http\Request;

class SettlementsController extends Controller
{
    public function markAsPaid($settlementId)
    {
        $settlement = settlements::findOrFail($settlementId);
        
        settlements::where('expenses_id', $settlement->expenses_id)
            ->where('debtor_id', \Auth::id())
            ->update(['is_paid' => true]);
        
        return redirect()->route('dashboard')->with('success', 'Settlement marked as paid!');
    }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(settlements $settlements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(settlements $settlements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, settlements $settlements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(settlements $settlements)
    {
        //
    }
}
