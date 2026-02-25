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

    public function show()
    {
        return view('memberspace');
    }

    public function create_colocation()
    {
        $colocation = $this->MemberService->create_colocation();

        if($colocation)
        {
            return redirect()->route('memberspace')->with('succesfuly to create this colocation');
        } 
    }

    public function create_expense()
    {
        $expences = $this->MemberService->create_expense();
        if($expences)
        {
            return redirect()->route('memberspace')->with('succesfuly to create this expence');
        }
    }
}
