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

    public function create_expense($user,$categories_id, $amount,$colocation_id, $description)
    {
        return $this->ExpenseRepository->create_expense($user,$categories_id, $amount,$colocation_id, $description);
    }
  }

?>