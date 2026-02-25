<?php

  namespace App\Http\Services;

  use App\Http\Repository\ExpenseRepository;

  class ExpenseService
  {
    private $ExpenseRepository;

    public function __construct(ExpenseRepository $ExpenseRepository)
    {
        $this->ExpenseRepository = $ExpenseRepository;
    }

    public function create_expense()
     {
        return $this->ExpenseRepository->create_expense();
     }
  }

?>