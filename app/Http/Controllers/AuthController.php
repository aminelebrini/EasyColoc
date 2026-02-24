<?php

namespace App\Http\Controllers;

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
}
