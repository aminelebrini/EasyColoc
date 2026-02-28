<?php

   namespace App\Http\Repository;
   use App\Models\Colocation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

   class CollocationRepository
   {
        public function create_colocation($name, $number,$user)
        {
            $coloc = Colocation::create([
                'name' => $name,
                'status' => 'active',
                'numbers' => $number
            ]);
            $coloc->save();

            
            DB::table('memberships')->insert([
            'member_id' => $user,
            'colocation_id' => $coloc->id,
            'role' => 'owner',
            'joined_at' => now(),
            'left_at' => null,
            ]);
        }

        public function leave_colocation($colocation_id, $user_id)
        {
            
                DB::table('memberships')
                ->where('colocation_id', $colocation_id)
                ->where('member_id', $user_id)
                ->update(['left_at' => now()]);

                User::where('id', $user_id)->update(['reputation' => DB::raw('reputation - 1')]);
        }
    }

?>