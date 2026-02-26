<?php

use App\Http\Controllers\BansController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ColocationsController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\InvitationsController;
use App\Http\Controllers\MembershipsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettlementsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard', [
            'stats' => [
                'total_users' => 0,
                'total_colocations' => 0,
                'total_expenses' => 0,
                'banned_users' => 0,
            ],
            'users' => collect(),
            'colocations' => collect(),
        ]);
    })->name('admin.dashboard');

    Route::get('/colocations', [ColocationsController::class, 'index'])->name('colocations.index');
    Route::get('/colocations/create', [ColocationsController::class, 'create'])->name('colocations.create');
    Route::post('/colocations', [ColocationsController::class, 'store'])->name('colocations.store');
    Route::get('/colocations/{colocations}', [ColocationsController::class, 'show'])->name('colocations.show');
    Route::get('/colocations/{colocations}/edit', [ColocationsController::class, 'edit'])->name('colocations.edit');
    Route::put('/colocations/{colocations}', [ColocationsController::class, 'update'])->name('colocations.update');
    Route::delete('/colocations/{colocations}', [ColocationsController::class, 'destroy'])->name('colocations.destroy');

    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpensesController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expenses}', [ExpensesController::class, 'show'])->name('expenses.show');
    Route::get('/expenses/{expenses}/edit', [ExpensesController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expenses}', [ExpensesController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expenses}', [ExpensesController::class, 'destroy'])->name('expenses.destroy');

    Route::get('/invitations', [InvitationsController::class, 'index'])->name('invitations.index');
    Route::get('/invitations/create', [InvitationsController::class, 'create'])->name('invitations.create');
    Route::post('/invitations', [InvitationsController::class, 'store'])->name('invitations.store');
    Route::get('/invitations/{invitations}', [InvitationsController::class, 'show'])->name('invitations.show');
    Route::get('/invitations/{invitations}/edit', [InvitationsController::class, 'edit'])->name('invitations.edit');
    Route::put('/invitations/{invitations}', [InvitationsController::class, 'update'])->name('invitations.update');
    Route::delete('/invitations/{invitations}', [InvitationsController::class, 'destroy'])->name('invitations.destroy');

    Route::get('/memberships', [MembershipsController::class, 'index'])->name('memberships.index');
    Route::get('/memberships/create', [MembershipsController::class, 'create'])->name('memberships.create');
    Route::post('/memberships', [MembershipsController::class, 'store'])->name('memberships.store');
    Route::get('/memberships/{memberships}', [MembershipsController::class, 'show'])->name('memberships.show');
    Route::get('/memberships/{memberships}/edit', [MembershipsController::class, 'edit'])->name('memberships.edit');
    Route::put('/memberships/{memberships}', [MembershipsController::class, 'update'])->name('memberships.update');
    Route::delete('/memberships/{memberships}', [MembershipsController::class, 'destroy'])->name('memberships.destroy');

    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categories}', [CategoriesController::class, 'show'])->name('categories.show');
    Route::get('/categories/{categories}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categories}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{categories}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

    Route::get('/settlements', [SettlementsController::class, 'index'])->name('settlements.index');
    Route::get('/settlements/create', [SettlementsController::class, 'create'])->name('settlements.create');
    Route::post('/settlements', [SettlementsController::class, 'store'])->name('settlements.store');
    Route::get('/settlements/{settlements}', [SettlementsController::class, 'show'])->name('settlements.show');
    Route::get('/settlements/{settlements}/edit', [SettlementsController::class, 'edit'])->name('settlements.edit');
    Route::put('/settlements/{settlements}', [SettlementsController::class, 'update'])->name('settlements.update');
    Route::delete('/settlements/{settlements}', [SettlementsController::class, 'destroy'])->name('settlements.destroy');

    Route::get('/bans', [BansController::class, 'index'])->name('bans.index');
    Route::get('/bans/create', [BansController::class, 'create'])->name('bans.create');
    Route::post('/bans', [BansController::class, 'store'])->name('bans.store');
    Route::get('/bans/{bans}', [BansController::class, 'show'])->name('bans.show');
    Route::get('/bans/{bans}/edit', [BansController::class, 'edit'])->name('bans.edit');
    Route::put('/bans/{bans}', [BansController::class, 'update'])->name('bans.update');
    Route::delete('/bans/{bans}', [BansController::class, 'destroy'])->name('bans.destroy');
});

require __DIR__.'/auth.php';

