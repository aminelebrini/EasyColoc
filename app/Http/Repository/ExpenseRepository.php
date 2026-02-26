<?php

   namespace App\Http\Repository;
   use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Settlement;
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
            ->where('member_id', $user)->get();

            $totalMembers = $members->count();
            
            $amountforperson = $amount / $totalMembers;

            foreach($members as $member)
            {
                $settlements = Settlement::create([
                    'amount' => $amount,
                    'debtor_id' => $member->id,
                    'creditor_id' => $user,
                ]);
            }


        }
   }

?>