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
            // dd($email)
            $user = User::where('email', $email)->first();

            $userRole = DB::table('memberships')
            ->where('member_id', $user->id)
            ->whereNull('left_at')
            ->select('role')
            ->first();

            if ($userRole) {
                return [
                    'status'  => false,
                    'message' => "Action interdite : Cet utilisateur fait déjà partie d'une colocation."
                ];
            }
            
                $Invitation = Invitation::create([
                  'email' => $email,
                  'token' => Hash::make($email),
                  'status' => 'pending',
                  'colocation_id' => $colocationId
                ]);

                $Invitation->save();

                return $Invitation;
            
            
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