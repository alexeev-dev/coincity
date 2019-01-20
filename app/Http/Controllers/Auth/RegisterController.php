<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserHouse;
use App\User;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller {

    use RegistersUsers;

    private $userService;

    protected $redirectTo = '/register/verification-code-sent';

    public function __construct(UserService $userService) {
        $this->userService = $userService;
        $this->middleware('guest');
    }

    public function register(Request $request) {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'confirmation_code' => str_random(30)
        ]);

        if (!empty($request->sh)) {
            $userHouse = new UserHouse();
            $userHouse->user_id = $user->id;
            $userHouse->house_id = $request->sh;
            $userHouse->money_collected = Carbon::now();
            $userHouse->position = 0;
            $userHouse->save();
        }

        $request->session()->flash('code_sent_to_email', $request->input('email'));
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    public function verification(Request $request) {
        $email = '';
        if ($request->has('email')) {
            $email = $request->input('email');
        }

        return view('auth.resend_verification', ['email' => $email]);
    }

    public function resendVerification(Request $request) {
        $request->validate([
            'email' => 'required|string|email'
        ]);

        $user = $this->userService->getUserByEmail($request->input('email'));

        if (empty($user)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.email_not_exist')]
            ]);
        } else if ($user->confirmed) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.already_confirmed')]
            ]);
        }

        $user->sendConfirmation();
        $request->session()->flash('code_sent_to_email', $request->input('email'));

        return redirect($this->redirectTo);
    }

    public function confirm($confirmationCode) {
        if (!$confirmationCode) {
            abort(404);
        }

        if ($this->userService->confirmUser($confirmationCode)) {
            return redirect('/register/verified');

        } else {
            // session()->flash('message', trans('auth.user_already_confirmed'));
            return redirect('/');
        }
    }
}
