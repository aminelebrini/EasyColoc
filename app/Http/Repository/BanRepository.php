<?php

namespace App\Http\Repository;
use App\Models\User;

class BanRepository
{
    public function banuer($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->is_banned = true;
            $user->save();
            return true;
        }
        return false;
    }

    public function debanuer($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->is_banned = false;
            $user->save();
            return true;
        }
        return false;
    }
}

?>