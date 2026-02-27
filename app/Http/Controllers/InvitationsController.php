<?php

namespace App\Http\Controllers;

use App\Models\invitations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationsController extends Controller
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
        return view('invitations.create');
    }

    public function generateKey()
    {
        $user = Auth::user();
        $colocation = $user->activeMembership->colocation;
        
        $invitation = invitations::create([
            'colocation_id' => $colocation->id,
            'invited_by' => Auth::id(),
            'token' => \Illuminate\Support\Str::random(32),
            'status' => 'pending',
            'email' => null,
            'message' => null,
            'expires_at' => null
        ]);

        return redirect()->route('invitations.create')->with('generatedToken', $invitation->token);
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
    public function show(invitations $invitations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invitations $invitations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invitations $invitations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invitations $invitations)
    {
        //
    }
}
