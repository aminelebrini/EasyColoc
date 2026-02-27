<?php

namespace App\Http\Services;

use App\Http\Repository\SettlementRepository;

class SettlementService
{
    protected $SettlementRepository;

    public function __construct(SettlementRepository $SettlementRepository)
    {
        $this->SettlementRepository = $SettlementRepository;
    }

    public function Paying($expenseId, $userId)
    {
        return $this->SettlementRepository->pay($expenseId, $userId);
    }
}