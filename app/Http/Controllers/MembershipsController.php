<?php

namespace App\Http\Controllers;

use App\Models\memberships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipsController extends Controller
{
    public function leave()
    {
        memberships::where('user_id', Auth::id())->whereNull('left_at')->delete();
        return redirect()->route('dashboard');
    }

    public function removeMember($membershipId)
    {
        $membership = memberships::findOrFail($membershipId);
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
