<?php

namespace App\Services;

use App\User;

class UserService {

    public function getUserByEmail($email) {
        $user = User::where('email', strtolower($email))->first();
        return $user ? $user : null;
    }

    public function confirmUser($confirmation_code) {
        $user = User::where('confirmation_code', $confirmation_code)->first();

        if (!$user) {
            return false;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        return true;
    }

    public function isConfirmed($email) {
        $user = User::where('email', strtolower($email))->first();
        return !empty($user) ? $user->confirmed == 1 : false;
    }
}
