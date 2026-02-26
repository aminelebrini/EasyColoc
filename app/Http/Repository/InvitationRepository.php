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
   }

?>