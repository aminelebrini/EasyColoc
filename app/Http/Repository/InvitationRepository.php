<?php

   namespace App\Http\Repository;
   use App\Models\Invitation;
   use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

   class InvitationRepository
   {
        public function sendInvitation($email, $colocationId)
        {
            $Invitation = Invitation::create([
                'email' => $email,
                'token' => Hash::make($email),
                'status' => 'pending',
                'colocation_id' => $colocationId
            ]);

            $Invitation->save();
        }
   }

?>