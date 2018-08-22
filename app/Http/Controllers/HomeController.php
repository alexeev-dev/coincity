<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Page;
use App\Models\Tweet;
use App\Models\UserHouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        $tweets = Tweet::all();

        if (!empty($user)) {
            $houses = House::whereRaw('id NOT IN (SELECT house_id FROM user_houses WHERE user_id = '.$user->id.' AND position IS NOT NULL)')
                ->orderBy('money_per_hour', 'DESC')->get();
            $allUserHouses = $user->user_houses()->get();
            $userHouses = $user->user_houses()->whereNotNull('position')->orderBy('position')->get();

            $yesterday = Carbon::now()->subHours(24);
            $built_last_24h = UserHouse::where('user_id', $user->id)->where('created_at', '>',
                $yesterday->toDateTimeString())->count();

            $isBlocked = ($built_last_24h >= 3 ? 1 : 0);

            if ($isBlocked) {
                $timeLeft = $user->user_houses()->latest()->first()->created_at->diffInSeconds(
                    Carbon::now()->subHours(24));
            } else {
                $timeLeft = 0;
            }
        } else {
            $houses = House::all();
            $allUserHouses = [];
            $userHouses = [];
            $isBlocked = false;
            $timeLeft = '';
        }

        return view('home', [
            'houses' => $houses,
            'allUserHouses' => $allUserHouses,
            'userHouses' => $userHouses,
            'tweets' => $tweets,
            'buildBlocked' => $isBlocked,
            'timeLeft' => $timeLeft
        ]);
    }

    public function getPage(Request $request) {
        $page = Page::where('alias', $request['alias'])->first();
        if (!empty($page)) {
            $html = view('partials.page', ['content' => $page->content])->render();
        } else {
            $html = view('errors.404')->render();
        }
        return json_encode(['html' => $html]);
    }

    public function getNews() {
        $tweets = Tweet::all();
        if (!empty($tweets)) {
            $html = view('partials.tweets', ['tweets' => $tweets])->render();
        } else {
            $html = view('errors.404')->render();
        }
        return json_encode(['html' => $html]);
    }

    public function singleNews(Request $request) {
        $singleNews = Tweet::where('alias', $request['alias'])->first();
        return view('single_news', [
            'singleNews' => $singleNews
        ]);
    }
}
