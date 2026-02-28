<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdmindashController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\CreateColocation;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SettlementContorller;
use App\Models\Settlement;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login',[AuthController::class, 'login'])->name('login.post');
Route::post('/register',[AuthController::class, 'register'])->name('register.post');
Route::middleware('auth')->get('/logout',[AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admindash',[AdmindashController::class,'show'])->name('admindash');
    Route::post('/colocations', [ColocationController::class, 'create_colocation'])->name('colocations.store');
    Route::post('/expenses', [ExpenseController::class, 'create_expense'])->name('expenses.store');
    Route::post('/invitations', [InvitationController::class, 'sendInvitation'])->name('invitations.send');
    Route::post('/categories', [CategorieController::class, 'CreateCategorie'])->name('categories.store');
    Route::post('/accept-invitation', [InvitationController::class, 'acceptInvitation'])->name('invitations.accept');
    Route::post('/refuse-invitation', [InvitationController::class, 'RefusInvitation'])->name('invitations.refuse');
    Route::post('/paying', [SettlementContorller::class, 'Paying'])->name('settlements.pay');
    Route::post('/leavecolocation', [ColocationController::class, 'leave_colocation'])->name('colocations.leave');
});

Route::middleware(['auth','role:user'])->group(function(){
    Route::get('/userspace',[UsersController::class,'show'])->name('userspace');
    Route::post('/colocations', [ColocationController::class, 'create_colocation'])->name('colocations.store');
    Route::post('/expenses', [ExpenseController::class, 'create_expense'])->name('expenses.store');
    Route::post('/invitations', [InvitationController::class, 'sendInvitation'])->name('invitations.send');
    Route::post('/categories', [CategorieController::class, 'CreateCategorie'])->name('categories.store');
    Route::post('/accept-invitation', [InvitationController::class, 'acceptInvitation'])->name('invitations.accept');
    Route::post('/refuse-invitation', [InvitationController::class, 'RefusInvitation'])->name('invitations.refuse');
    Route::post('/paying', [SettlementContorller::class, 'Paying'])->name('settlements.pay');
    Route::post('/leavecolocation', [ColocationController::class, 'leave_colocation'])->name('colocations.leave');

});


