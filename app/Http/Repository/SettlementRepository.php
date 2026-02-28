<?php

namespace App\Http\Repository;

use App\Models\Expense;
use App\Models\Settlement;
use App\Models\User;
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

            User::where('id', $userId)->update(['reputation' => DB::raw('reputation + 1')]);
            return $settlement;
        }
        return false;
    }
}