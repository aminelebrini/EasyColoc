<?php

namespace App\Http\Repository;

use App\Models\Expense;
use App\Models\Settlement;
use Illuminate\Support\Facades\DB;

class SettlementRepository
{
    public function pay(int $expenseId, int $userId)
    {
        $expense = Expense::find($expenseId);
        
        if (!$expense) {
            return false; 
        }

        $count = DB::table('memberships')
            ->where('colocation_id', $expense->colocation_id)
            ->whereNull('left_at')
            ->count();
        
        $part = $expense->amount / ($count ?: 1);

        $check = Settlement::where('expense_id', $expenseId)
                           ->where('debtor_id', $userId)
                           ->first();

        if ($check) {
            return $check;
        }

        return Settlement::create([
            'amount'      => $part,         
            'is_paid'     => true,          
            'debtor_id'   => $userId,       
            'creditor_id' => $expense->user_id, 
            'expense_id'  => $expenseId,   
        ]);
    }
}