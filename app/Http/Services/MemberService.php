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
  }

?>