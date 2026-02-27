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

            $totalamount = $expense->amount;

            $totalMembers = $members->count();
            
            $amountforperson = $totalamount / $totalMembers;

            // dd($expense);
            foreach($members as $member)
            {
                $isPayer = ($member->member_id == $user);

                if ($isPayer) {
                    Settlement::create([
                        'amount' => $amountforperson,
                        'is_paid' => $isPayer ? true : false,
                        'debtor_id' => $member->id,
                        'creditor_id' => $user,
                        'expense_id' => $expense->id
                    ]);
                }
            }


        }
   }

?>