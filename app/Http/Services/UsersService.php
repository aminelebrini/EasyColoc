<?php

  namespace App\Http\Services;

  use App\Http\Repository\UsersRepository;

  class UsersService
  {
     private $UsersRepository;

     public function __construct(UsersRepository $UsersRepository)
     {
        $this->UsersRepository = $UsersRepository;
     }

     public function getcol($userid)
     {
        return $this->UsersRepository->getcol($userid);
     }

     public function getMember($userid)
     {
         return $this->UsersRepository->getMember($userid);
     }

      public function getCategorie()
      {
         return $this->UsersRepository->getCategorie();
      }
      public function getExpenses()
      {
         return $this->UsersRepository->getExpenses();
      }

      public function getInvitations($user)
      {
         return $this->UsersRepository->getInvitations($user);
      }
  }

?>