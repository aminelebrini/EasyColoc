<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = $this->AuthService->login($request->email,$request->password);

        Auth::login($user);
        $request->session()->regenerate();

        if($user->role === 'admin')
        {
            return redirect()->route('admindash'); 
        }
        if($user->role === 'user')
        {
            return redirect()->route('userspace');
        }

    }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required | string',
            'lastname' => 'required | string',
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $register = $this->AuthService->register($request->firstname, $request->lastname, $request->email,$request->password);
        if($register)
        {
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
