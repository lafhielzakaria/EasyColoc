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
        
        if (!$user->activeMembership || !$user->activeMembership->colocation) {
            return redirect()->back()->withErrors(['error' => 'You must be in a colocation to generate invitation keys']);
        }
        
        $colocation = $user->activeMembership->colocation;
        
        $invitation = invitations::create([
            'colocation_id' => $colocation->id,
            'invited_by' => Auth::id(),
            'token' => \Illuminate\Support\Str::random(10),
            'status' => 'pending',
            'email' => null,
            'message' => null,
            'expires_at' => null
        ]);

        return redirect()->route('invitations.create')->with('generatedToken', $invitation->token);
    }

    public function join()
    {
        return view('invitations.join');
    }

    public function email()
    {
        return view('invitations.email');
    }

    public function joinByEmail($colocationId)
    {
        \App\Models\memberships::create([
            'user_id' => Auth::id(),
            'colocation_id' => $colocationId,
            'role' => 'member',
            'joined_at' => now(),
        ]);

        invitations::where('colocation_id', $colocationId)
            ->where('email', Auth::user()->email)
            ->update(['status' => 'accepted', 'accepted_at' => now()]);

        return redirect()->route('dashboard');
    }

    public function rejectByEmail($colocationId)
    {
        invitations::where('colocation_id', $colocationId)
            ->where('email', Auth::user()->email)
            ->update(['status' => 'rejected']);

        return redirect()->route('dashboard');
    }

    public function accept(Request $request)
    {
        $invitation = invitations::where('token', $request->token)->first();

        if (!$invitation) {
            return redirect()->back()->withErrors(['token' => 'Invalid token']);
        }

        \App\Models\memberships::create([
            'user_id' => Auth::id(),
            'colocation_id' => $invitation->colocation_id,
            'role' => 'member',
            'joined_at' => now(),
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'No user found with this email']);
        }
        
        if ($user->id === Auth::id()) {
            return redirect()->back()->withErrors(['email' => 'You cannot invite yourself']);
        }

        if (\App\Models\memberships::where('user_id', $user->id)->whereNull('left_at')->exists()) {
            return redirect()->back()->withErrors(['email' => 'This user already has an active colocation']);
        }

        $currentUser = Auth::user();
        if (!$currentUser->activeMembership || !$currentUser->activeMembership->colocation) {
            return redirect()->back()->withErrors(['error' => 'You must be in a colocation to send invitations']);
        }
        
        $colocation = $currentUser->activeMembership->colocation;
        
        if (invitations::where('colocation_id', $colocation->id)
            ->where('email', $request->email)
            ->where('status', 'pending')
            ->exists()) {
            return redirect()->back()->withErrors(['email' => 'An invitation is already pending for this email']);
        }

        invitations::create([
            'colocation_id' => $colocation->id,
            'invited_by' => Auth::id(),
            'email' => $request->email,
            'status' => 'pending',
            'token' => null,
            'message' => null,
            'expires_at' => null
        ]);

        $user->notify(new \App\Notifications\ColocationInvitation($colocation->id, $colocation->name));

        return redirect()->route('invitations.create')->with('success', 'Invitation sent successfully');
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
