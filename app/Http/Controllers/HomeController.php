<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $tweets = Tweet::all();
        $houses = House::whereRaw('id NOT IN (SELECT house_id FROM user_houses WHERE position IS NOT NULL)')->get();
        $userHouses = Auth::user()->user_houses()->whereNotNull('position')->orderBy('position')->get();

        return view('home', [
            'tweets' => $tweets,
            'houses' => $houses,
            'userHouses' => $userHouses
        ]);
    }
}
