<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Page;
use App\Models\Tweet;
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
        } else {
            $houses = House::all();
            $allUserHouses = [];
            $userHouses = [];
        }

        return view('home', [
            'houses' => $houses,
            'allUserHouses' => $allUserHouses,
            'userHouses' => $userHouses,
            'tweets' => $tweets
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
