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

     public function create_colocation($name, $number,$user)
     {
        return $this->MemberRepository->create_colocation($name, $number,$user);
     }

     public function create_expense()
     {
        return $this->MemberRepository->create_expense();
     }

     public

     public function getcol($userid)
     {
        return $this->MemberRepository->getcol($userid);
     }
  }

?>