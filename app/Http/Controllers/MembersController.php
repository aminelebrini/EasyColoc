<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Services\MemberService;

class MembersController extends Controller
{
    private $MemberService;

    public function __construct(MemberService $MemberService)
    {
        $this->MemberService = $MemberService;
    }
}
