<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\InvitationService;

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

        if($invitation)
        {
            return redirect()->route('userspace');
        }
    }
}
