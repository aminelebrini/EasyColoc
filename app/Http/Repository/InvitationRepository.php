<?php

   namespace App\Http\Repository;
   use App\Models\Invitation;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

   class InvitationRepository
   {
        public function sendInvitation($email, $colocationId)
        {
            $user = User::where('email', $email)->first();
            if($user)
            {
                $Invitation = Invitation::create([
                  'email' => $email,
                  'token' => Hash::make($email),
                  'status' => 'pending',
                  'colocation_id' => $colocationId
                ]);

                $Invitation->save();
            }else{
                return false;
            }
            
        }

        public function acceptInvitation($user)
        {
            $acceptInvitation = Invitation::where('email', $user->email)->update(['status' => 'accepted']);

            $getInvitation = Invitation::where('email', $user->email)->first();

            $Addmemberships = DB::table('memberships')->insert([
                'member_id' => $user->id,
                'colocation_id' => $getInvitation->colocation_id,
                'role' => 'member',
                'joined_at' => now()
            ]);

            return $Addmemberships;
        }
   }

?>