<?php
   
   namespace App\Http\Repository;

   use App\Models\Colocation;
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
   }


?>