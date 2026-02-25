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

    public function create_colocation(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'number' => 'required|integer|max:5'
        ]);
        $user = Auth::user()->id;
        // dd($user);
        $colocation = $this->MemberService->create_colocation($request->name, $request->number,$user);
        
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

    public function sendInvitation(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $invitation = $this->MemberService->sendInvitation($request->email);
    }
}
