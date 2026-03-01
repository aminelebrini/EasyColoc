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
        if (!$invitation['status']) {
            return back()->with('error', $invitation['message']);
        }
            return back()->with('success', $invitation['message']);
        }

    public function acceptInvitation()
    {
        $user = Auth::user();
        $accept = $this->InvitationService->acceptInvitation($user);

        if($accept)
        {
            return redirect()->back()->with('success','Invitation acceptée avec succès !');
        }
        else{
            return redirect()->back()->with('error', "L'invitation n'a pas été acceptée.");
        }
    }
}
