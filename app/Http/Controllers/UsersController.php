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
        $user = Auth::user();
        $colocation = $this->UsersService->getcol($userid);
        $memberships = $this->UsersService->getMember($userid);
        $categories  = $this->UsersService->getCategorie();
        $expenses = $this->UsersService->getExpenses();
        $invitations = $this->UsersService->getInvitations($user);
        
        return view('userspace',[
            'colocation' => $colocation,
            'memberships' => $memberships,
            'categories' => $categories,
            'expenses' => $expenses,
            'invitations' => $invitations
        ]);
    }
}
