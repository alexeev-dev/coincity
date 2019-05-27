<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function process($provider)
    {
        $socUser = Socialite::driver($provider)->user();
        $email = $socUser->getEmail();

        if (empty($email)) {
            abort(403, 'Email не задан в вашем социальном аккаунте');
        }

        $user = User::where('email', $email)->first();

        if (empty($user)) {
            // register new
            $newPass = bcrypt(Str::random(6));

            $user = User::create([
                'name' => $socUser->getName(),
                'email' => $email,
                'password' => $newPass,
                'confirmation_code' => Str::random(30)
            ]);

            session()->flash('success-message', '
                <p>
                    Successfully registered via '.ucfirst($provider).',<br>
                    Email - <strong>'.$user->email.'</strong><br>.
                    New password - <strong>'.$newPass.'</strong>.
                </p>');
        } else {
            session()->flash('success-message', '
                <p>Successfully logged in via '.ucfirst($provider).'</p>');
        }

        Auth::loginUsingId($user->id, true);

        return redirect(route('home'));
    }
}
