<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\ProfileController;
use App\Mail\FeedbackMessage;
use App\Models\House;
use App\Models\Page;
use App\Models\Tweet;
use App\Models\UserHouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
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

    public function getNews()
    {
        $user = Auth::user();
        $tweets = Tweet::orderBy('pub_date', 'desc')->orderBy('id', 'desc')->take(ProfileController::TWEETS_SHOW_COUNT + 1)->get();

        if (empty($tweets)) {
            abort(403);
        }

        $newTweetCount = $this->getNewTweetCount();

        $html = view('partials.ajax_content.tweets', [
            'tweets' => $tweets,
            'pageSize' => ProfileController::TWEETS_SHOW_COUNT,
            'newTweetCount' => $newTweetCount,
        ])->render();

        if (!empty($user)) {
            $user->user_stat->last_tweet_read = $tweets->first()->pub_date;
            $user->user_stat->save();
        }

        return json_encode([
            'html' => $html
        ]);
    }

    public function moreNews(Request $request)
    {
        if (empty($request->tweets) || $request->tweets >= ProfileController::MAX_TWEETS_SHOW_COUNT) {
            abort(403);
        }

        if (ProfileController::MAX_TWEETS_SHOW_COUNT - $request->tweets > ProfileController::TWEETS_SHOW_COUNT) {
            $tweetsToTake = ProfileController::TWEETS_SHOW_COUNT + 1;
        } else {
            $tweetsToTake = ProfileController::MAX_TWEETS_SHOW_COUNT - $request->tweets;
        }

        $tweets = Tweet::orderBy('pub_date', 'desc')->orderBy('id', 'desc')->skip($request->tweets)
            ->take($tweetsToTake)->get();

        if (empty($tweets)) {
            abort(403);
        }

        $html = view('partials.ajax_content.more_tweets', [
            'tweets' => $tweets,
            'pageSize' => ProfileController::TWEETS_SHOW_COUNT,
        ])->render();

        return json_encode([
            'html' => $html
        ]);
    }

    public function singleNews(Request $request)
    {
        $singleTweetPage = Tweet::where('alias', $request['alias'])->first();

        if (empty($singleTweetPage)) {
            return view('errors.404');
        }

        return view('single_page', [
            'content' => $singleTweetPage->content
        ]);
    }

    public function getPage(Request $request)
    {
        $page = Page::where('alias', $request['alias'])->first();

        if (empty($page)) {
            return view('errors.404');
        }

        return view('single_page', [
            'content' => $page->content
        ]);
    }

    public function sendFeedback(Request $request)
    {
        if (empty($request->feedback)) {
            abort(403);
        }

        Mail::to('feedback@cryptodales.com')->queue(new FeedbackMessage($request->feedback));

        return json_encode([
            'html' => '<p>Thank you. Your message has been sent.</p>'
        ]);
    }

    private function getNewTweetCount()
    {
        $user = Auth::user();
        $newTweetCount = 0;

        if (!empty($user)) {
            $lastTweetRead = $user->user_stat->last_tweet_read;

            if (empty($lastTweetRead)) {
                $newTweetCount = Tweet::orderBy('pub_date', 'desc')->orderBy('id', 'desc')
                    ->take(ProfileController::MAX_TWEETS_SHOW_COUNT)->count();
            } else {
                $newTweetCount = Tweet::where('pub_date', '>', $lastTweetRead)
                    ->orderBy('pub_date', 'desc')->orderBy('id', 'desc')
                    ->take(ProfileController::MAX_TWEETS_SHOW_COUNT)->count();
            }

            if ($newTweetCount > 99) {
                $newTweetCount = 99;
            }
        }

        return $newTweetCount;
    }
}
