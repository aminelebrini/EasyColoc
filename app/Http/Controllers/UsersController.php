<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Services\UsersService;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    private $UsersService;

    public function __construct(UsersService $UsersService)
    {
        $this->UsersService = $UsersService;
    }

    public function show()
    {
        $userid = Auth::user()->id;
        $colocation = $this->UsersService->getcol($userid);
        $memberships = $this->UsersService->getMember($userid);
        return view('userspace',[
            'colocation' => $colocation,
            'memberships' => $memberships
        ]);
    }
}
