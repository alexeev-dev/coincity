<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        return view('user/profile', compact('user'));
    }

    public function update(Request $request) {
        $user = Auth::user();
        $rules = array(
            'name' => 'required|string|max:50',
        );

        Validator::make($request->all(), $rules)->validate();

        $user->name = $request['name'];
        $user->save();

        return redirect(route('profile'));
    }
}
