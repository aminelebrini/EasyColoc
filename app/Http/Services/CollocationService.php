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
  }

?>