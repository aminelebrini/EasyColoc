<?php
   
   namespace App\Http\Repository;

   use App\Models\Colocation;
   use Illuminate\Support\Facades\DB;

   class MemberRepository
   {
        public function getcol($userid)
        {
            $membership = DB::table('memberships')
            ->where('member_id', $userid)
            ->whereNull('left_at')
            ->first();
            $colocation = Colocation::where('id', $membership->colocation_id)->first();

            return $colocation;
        }
   }


?>