<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdmindashController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login',[AuthController::class, 'login'])->name('login.post');
Route::post('/register',[AuthController::class, 'register'])->name('register.post');

Route::middleware(['auth','admin'])->group(function(){
    Route::get('/admindash',[AdmindashController::class,'index'])->name('admindash');
});
