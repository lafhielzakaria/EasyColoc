<?php

namespace App\Http\Controllers;

use App\Models\colocations;
use App\Models\expenses;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = request('show') === 'all' ? User::all() : User::limit(10)->get();
        
        return view('admin.dashboard', [
            'stats' => [
                'total_users' => User::count(),
                'total_colocations' => colocations::count(),
                'total_expenses' => expenses::count(),
                'banned_users' => User::where('is_banned', true)->count(),
            ],
            'users' => $users,
            'colocations' => colocations::all(),
        ]);
    }

    public function banUser(User $user)
    {
        $user->update(['is_banned' => true]);
        return back();
    }

    public function unbanUser(User $user)
    {
        $user->update(['is_banned' => false]);
        return back();
    }
}
