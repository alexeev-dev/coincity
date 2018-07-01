<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller {

    use AuthenticatesUsers;

    private $users;

    protected $redirectTo = '/user/profile';

    public function __construct(UserService $users) {
        $this->users = $users;
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request) {
        $is_confirmed = $this->users->isConfirmed($request->input('email'));

        if(!is_null($is_confirmed) && !$is_confirmed) {
            $request->session()->flash('not_confirmed', true);
            throw ValidationException::withMessages([
                'email' => [trans('auth.not_confirmed')]
            ]);
        }

        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
}
