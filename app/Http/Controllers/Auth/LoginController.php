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

    protected $redirectTo = '/';

    public function __construct(UserService $users) {
        $this->users = $users;
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request) {

        if (!($this->users->isConfirmed($request->email))) {
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
