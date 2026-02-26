<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\InvitationService;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    private $InvitationService;

    public function __construct(InvitationService $InvitationService)
    {
        $this->InvitationService = $InvitationService;
    }

    public function sendInvitation(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'colocation_id' => 'required|exists:colocations,id'
        ]);
        
        $invitation = $this->InvitationService->sendInvitation($request->email, $request->colocation_id);

        if(!$invitation)
        {
            return redirect()->back()->with('error', "The user doesn't exist with this email");
        }
        else{
            return redirect()->back()->with('success', "Invitation envoyée !");
        }
    }

    public function acceptInvitation()
    {
        $user = Auth::user();
        $accept = $this->InvitationService->acceptInvitation($user);

        if($accept)
        {
            return redirect()->back()->with('success','the invitation has been successfuly accepted');
        }
        else{
            return redirect()->back()->with('error', 'the invitation has not been accepted');
        }
    }
}
