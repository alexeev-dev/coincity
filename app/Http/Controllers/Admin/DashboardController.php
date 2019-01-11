<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

class DashboardController extends Controller
{
    public function index() {
        $users = User::orderBy('id', 'DESC')->get();

        return view('admin.dashboard', [
            'users' => $users
        ]);
    }

    public function editor() {
        return view('admin.editor');
    }
}
