<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdmindashController;
use App\Http\Controllers\MembersController;
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
    Route::get('/userspace',[MembersController::class,'show'])->name('userspace');
    Route::post('/userspace/create_colocation',[MembersController::class, 'create_colocation'])->name('colocations.store');
    Route::post('/create_expense',[MembersController::class, 'create_expense'])->name('expenses.store');
});
