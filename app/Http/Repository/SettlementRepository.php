<?php

namespace App\Http\Repository;

use App\Models\Expense;
use App\Models\Settlement;
use Illuminate\Support\Facades\DB;

class SettlementRepository
{
    public function pay($expenseId, $userId)
    {

        $settlement = Settlement::where('expense_id', $expenseId)
                                ->where('debtor_id', $userId)
                                ->first();

        if ($settlement) {
            $settlement->is_paid = true;
            $settlement->save();

            return $settlement;
        }
        return false;
    }
}