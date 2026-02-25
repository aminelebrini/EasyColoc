<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function login($email,$password)
    {
        $user = User::where('email', $email)->first();

        if(Hash::check($password, $user->password))
        {
            return $user;
        }

    }
    public function register($firstname, $lastname, $email,$password)
    {
        $user = User::where('email', $email)->first();
        if($user)
        {
            return redirect('/login')->with('There is a user who already exists with this email address.');
        }else
        {
            $role = User::count();
            if($role === 0)
            {
                $role = "admin";
            }else{
                $role = "user";
            }

            User::create([
              'firstname' => $firstname,
              'lastname' => $lastname,
              'email' => $email,
              'password'=> Hash::make($password),
              'role' => $role,
              'is_banned' => false
           ]);
        }
    }
}

?>