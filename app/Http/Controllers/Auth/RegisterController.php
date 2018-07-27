<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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

    protected function validator(array $data) {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function register(Request $request) {
        $this->validator($request->all())->validate();

        $user = User::create([
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            //'confirmation_code' => str_random(30)
            'confirmed' => 1
        ]);

        $request->session()->flash('code_sent_to_email', $request->input('email'));
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    public function verification(Request $request) {
        $email = '';
        if($request->has('email')) {
            $email = $request->input('email');
        }

        return view('auth.resend_verification', compact('email'));
    }

    public function resendVerification(Request $request) {
        $rules = array(
            'email' => 'required|string|email'
        );

        Validator::make($request->all(), $rules)->validate();

        $user = $this->userService->byEmail($request->input('email'));

        if (is_null($user)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.email_not_exist')]
            ]);
        } elseif($user->confirmed) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.already_confirmed')]
            ]);
        }

        $user->sendConfirmation();
        $request->session()->flash('code_sent_to_email', $request->input('email'));

        return redirect($this->redirectTo);
    }

    public function confirm($confirmation_code) {
        if (!$confirmation_code) {
            abort(404);
        }

        if ($this->userService->confirmUser($confirmation_code)) {
            return redirect('/register/verified');
        } else {
            session()->flash('message', trans('auth.user_already_confirmed'));
            return redirect('/');
        }
    }
}
