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
}
