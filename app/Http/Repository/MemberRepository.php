<?php
   
   namespace App\Http\Repository;

   use App\Models\Colocation;
   use Illuminate\Support\Facades\DB;

   class MemberRepository
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

        public function create_expense()
        {

        }
   }


?>