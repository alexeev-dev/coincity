<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\ProfileController;
use App\Models\House;
use App\Models\Page;
use App\Models\Tweet;
use App\Models\UserHouse;
use App\Models\UserReadTweet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();

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

            // new tweet count
            $newTweetCount = $this->getNewTweetCount();

        } else {
            $houses = House::all();
            $allUserHouses = [];
            $userHouses = [];
            $isBlocked = false;
            $timeLeft = '';
            $newTweetCount = 0;
        }

        return view('home', [
            'houses' => $houses,
            'allUserHouses' => $allUserHouses,
            'userHouses' => $userHouses,
            'newTweetCount' => $newTweetCount,
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
        $user = Auth::user();
        $tweets = Tweet::orderBy('pub_date', 'desc')->take(ProfileController::TWEETS_SHOW_COUNT)->get();

        if (!empty($tweets)) {
            $newTweetCount = 0;
            if (!empty($user)) {
                $newTweetCount = $this->getNewTweetCount();
            }

            $html = view('partials.tweets', [
                'tweets' => $tweets,
                'newTweetCount' => $newTweetCount
            ])->render();

        } else {
            $html = view('errors.404')->render();
        }

        if (!empty($user)) {
            // mark as seen
            foreach ($tweets as $tweet) {
                $userReadTweet = $tweet->current_user_read();
                if (empty($userReadTweet)) {
                    $userReadTweet = new UserReadTweet();
                    $userReadTweet->user_id = $user->id;
                }

                $userReadTweet->tweet_id = $tweet->id;
                $userReadTweet->status = 1;
                $userReadTweet->save();
            }
            //$newTweetCount = $this->getNewTweetCount();

        } else {
            //$newTweetCount = 0;
        }


        return json_encode([
            'html' => $html
            //'newTweetCount' => $newTweetCount
        ]);
    }

    public function singleNews(Request $request) {
        $singleNews = Tweet::where('alias', $request['alias'])->first();
        return view('single_news', [
            'singleNews' => $singleNews
        ]);
    }

    private function getNewTweetCount() {
        $newTweetCount = Tweet::orderBy('pub_date', 'desc')->take(ProfileController::TWEETS_SHOW_COUNT)
            ->whereDoesntHave('user_read_tweets', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->count();
        return $newTweetCount;
    }
}
