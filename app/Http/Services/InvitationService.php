<?php

  namespace App\Http\Services;

  use App\Http\Repository\InvitationRepository;

  class InvitationService
  {
    private $InvitationRepository;

    public function __construct(InvitationRepository $InvitationRepository)
    {
        $this->InvitationRepository = $InvitationRepository;
    }

    public function sendInvitation($email)
     {
        return $this->InvitationRepository->sendInvitation($email);
     }
  }

?>