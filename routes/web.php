<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdmindashController;
use App\Http\Controllers\CreateColocation;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login',[AuthController::class, 'login'])->name('login.post');
Route::post('/register',[AuthController::class, 'register'])->name('register.post');

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admindash',[AdmindashController::class,'show'])->name('admindash');
});

Route::middleware(['auth','role:user,admin'])->group(function(){
    Route::get('/userspace',[UsersController::class,'show'])->name('userspace');
    Route::post('/userspace/create_colocation',[CreateColocation::class, 'create_colocation'])->name('colocations.store');
    Route::post('/userspace/create_expense',[ExpenseController::class, 'create_expense'])->name('expenses.store');
    Route::post('/userspace/sendInvitation',[InvitationController::class, 'sendInvitation'])->name('invitations.send');
    Route::get('/logout',[AuthController::class, 'logout']);

});


