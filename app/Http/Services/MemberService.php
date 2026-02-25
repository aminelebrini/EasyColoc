<?php

  namespace App\Http\Services;

  use App\Http\Repository\MemberRepository;

  class MemberService
  {
     private $MemberRepository;

     public function __construct(MemberRepository $MemberRepository)
     {
        $this->MemberRepository = $MemberRepository;
     }

     public function getcol($userid)
     {
        return $this->MemberRepository->getcol($userid);
     }
  }

?>