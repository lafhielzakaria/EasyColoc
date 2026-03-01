<?php

namespace App\Http\Controllers;

use App\Models\memberships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipsController extends Controller
{
    public function leave()
    {
        $membership = memberships::where('user_id', Auth::id())->whereNull('left_at')->first();
        
        $hasUnpaidDebt = \App\Models\settlements::where('is_paid', false)
            ->where('debtor_id', Auth::id())
            ->whereHas('expenses', function($query) use ($membership) {
                $query->where('colocation_id', $membership->colocation_id);
            })
            ->exists();
        
        if ($hasUnpaidDebt) {
            Auth::user()->decrement('reputation');
        }
        
        $membership->delete();
        return redirect()->route('dashboard');
    }

    public function removeMember($membershipId)
    {
        $membership = memberships::findOrFail($membershipId);
        $ownerMembership = memberships::where('colocation_id', $membership->colocation_id)
            ->where('role', 'owner')
            ->first();
        
        \App\Models\settlements::where('debtor_id', $membership->user_id)
            ->where('is_paid', false)
            ->whereHas('expenses', function($query) use ($membership) {
                $query->where('colocation_id', $membership->colocation_id);
            })
            ->update(['debtor_id' => $ownerMembership->user_id]);
        
        $membership->user->decrement('reputation');
        $membership->delete();
        return redirect()->route('dashboard');
    }

    public function transferOwnership($membershipId)
    {
        $newOwnerMembership = memberships::findOrFail($membershipId);
        $currentOwnerMembership = memberships::where('colocation_id', $newOwnerMembership->colocation_id)
            ->where('role', 'owner')
            ->first();
        
        $currentOwnerMembership->update(['role' => 'member']);
        $newOwnerMembership->update(['role' => 'owner']);
        
        return redirect()->route('dashboard');
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
    public function show(memberships $memberships)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(memberships $memberships)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, memberships $memberships)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(memberships $memberships)
    {
        //
    }
}
