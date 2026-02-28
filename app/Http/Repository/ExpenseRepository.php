<?php

   namespace App\Http\Repository;
   use App\Models\Colocation;
   use App\Models\Expense;
   use App\Models\Settlement;
   use App\Models\User;
   use Illuminate\Support\Facades\DB;

   class ExpenseRepository
   {
        public function create_expense($user,$categories_id, $amount,$colocation_id, $description)
        {
            $expense = Expense::create([
                'amount' => $amount,
                'description' => $description,
                'user_id' => $user,
                'colocation_id' => $colocation_id,
                'category_id' => $categories_id
            ]);

            $members = DB::table('memberships')
            ->where('colocation_id', $colocation_id)
            ->whereNull('left_at')
            ->get();

            $totalamount = $expense->amount;

            $totalMembers = $members->count();
            
            $amountforperson = $totalamount / $totalMembers;

        foreach ($members as $member) {
            Settlement::create([
            'amount' => $amountforperson,    
            'is_paid'    => ($member->member_id == $user) ? true : false,
            'debtor_id'  => $member->member_id,
            'creditor_id' => $user,
            'expense_id' => $expense->id,
            'created_at' => now(),
            'updated_at' => now(),
            ]);
        }

        $settlement = Settlement::where('expense_id', $expense->id)
                    ->where('debtor_id', $user)->first();
        if($settlement && $settlement->is_paid == true){
            User::where('id', $user)->update(['reputation' => DB::raw('reputation + 1')]);
        }

        return $expense;
            


        }
   }

?>