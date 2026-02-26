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

            $expences = Expense::join('categories' , 'expenses.category_id', '=', 'categories.id')
            ->join('users', 'expenses.user_id', '=', 'users.id')
            ->where('expenses.colocation_id', $userMembership->colocation_id)
            ->select('expenses.*','users.firstname as debitorfirstname','users.lastname as debitorlastname',
            'categories.name as category_name')->get();


            return $expences;
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