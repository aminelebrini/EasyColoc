<?php

  namespace App\Http\Services;

  use App\Http\Repository\CollocationRepository;

  class CollocationService
  {
      private $CollocationRepository;

      public function __construct(CollocationRepository $CollocationRepository)
      {
          $this->CollocationRepository = $CollocationRepository;
      }

      public function create_colocation($name, $number,$user)
      {
          return $this->CollocationRepository->create_colocation($name, $number,$user);
      }

      public function leave_colocation($colocation_id, $user_id)
      {
          return $this->CollocationRepository->leave_colocation($colocation_id, $user_id);
      }

  }

?>