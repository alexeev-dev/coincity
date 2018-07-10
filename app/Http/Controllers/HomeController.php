<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        $tweets = Tweet::all();

        if (!empty($user)) {
            $houses = House::whereRaw('id NOT IN (SELECT house_id FROM user_houses WHERE user_id = '.$user->id.' AND position IS NOT NULL)')->get();
            $userHouses = $user->user_houses()->whereNotNull('position')->orderBy('position')->get();
        } else {
            $houses = House::all();
            $userHouses = [];
        }

        return view('home', [
            'tweets' => $tweets,
            'houses' => $houses,
            'userHouses' => $userHouses
        ]);
    }
}
