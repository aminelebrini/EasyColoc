<?php
   
   namespace App\Http\Repository;

use App\Models\Categorie;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Invitation;
use Illuminate\Support\Facades\DB;

   class UsersRepository
   {
        public function getcol($userid)
        {
            return DB::table('colocations')
            ->join('memberships', 'colocations.id', '=', 'memberships.colocation_id')
            ->where('memberships.member_id', $userid)
            ->whereNull('memberships.left_at')
            ->select('colocations.*', 'memberships.role as user_role')
             ->first();

            return $colocation;
        }

        public function getMember($userid)
        {
            $userMembership = DB::table('memberships')
            ->where('member_id', $userid)
            ->whereNull('left_at')
            ->first();

            if (!$userMembership) {
                return collect(); 
            }

            return DB::table('memberships')
            ->join('users', 'memberships.member_id', '=', 'users.id')
            ->where('memberships.colocation_id', $userMembership->colocation_id)
            ->whereNull('memberships.left_at')
            ->select(
                'users.firstname', 
                'users.lastname', 
                'memberships.role', 
                'users.id as user_id'
            )
            ->get();
        }

        public function getCategorie()
        {
            $categorie = Categorie::all();

            return $categorie;
        }

        public function getExpenses($userid)
       {
        $userMembership = DB::table('memberships')
        ->where('member_id', $userid)
        ->whereNull('left_at')
        ->first();

    if (!$userMembership) return collect();

    $membersCount = DB::table('memberships')
        ->where('colocation_id', $userMembership->colocation_id)
        ->whereNull('left_at')
        ->count();

    return Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
        ->join('users as creditor', 'expenses.user_id', '=', 'creditor.id')
        ->join('settlements', 'expenses.id', '=', 'settlements.expense_id')
        ->join('users as debtor', 'settlements.debtor_id', '=', 'debtor.id')
        ->where('expenses.colocation_id', $userMembership->colocation_id)
        ->select(
            'expenses.*',
            'creditor.firstname as creditorfirstname',
            'creditor.lastname as creditorlastname',
            'debtor.firstname as debtorfirstname',
            'debtor.lastname as debtorlastname',
            'categories.name as category_name',
            'settlements.amount as settlement_amount',
            'settlements.is_paid as payment_status',
            'settlements.creditor_id as paid_to_user',
            'settlements.debtor_id as paid_by_user'
        )
        ->get();

}

        public function getInvitations($user)
        {
            $colocation = Colocation::all();

            $invitations = Invitation::join('colocations', 'invitations.colocation_id', '=', 'colocations.id')
            ->where('invitations.email', '=', $user->email)
            ->where('invitations.status', '=', 'pending')->select(
                'invitations.*', 
                'colocations.name as colocation_name',
            )->get();

            return $invitations;
        }
   }


?>