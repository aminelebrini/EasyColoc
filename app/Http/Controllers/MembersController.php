<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Services\MemberService;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
{
    private $MemberService;

    public function __construct(MemberService $MemberService)
    {
        $this->MemberService = $MemberService;
    }

    public function show()
    {
        $userid = Auth::user()->id;
        $colocation = $this->MemberService->getcol($userid);
        return view('userspace',[
            'colocation' => $colocation
        ]);
    }
}
