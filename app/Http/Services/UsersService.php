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
  }

?>