<?php

namespace App\Http\Controllers\User;

use App\Models\Adv;
use App\Models\Tweet;
use App\Models\UserHouseUpdate;
use App\Models\TweetUpdate;
use App\Models\House;
use App\Models\UserHouse;
use App\Models\UserReadTweet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    const SERVER_PING_TIME = 10;

    const SECONDS_TILL_NEXT_MONEY = 60;
    const HOURS_PER_ADV_CLICK = 8;
    const SECONDS_PER_MONEY_GATHER = 60;

    const TWEETS_SHOW_COUNT = 10;
    const MAX_TWEETS_SHOW_COUNT = 100;

    public function switchSound()
    {
        $userStat = Auth::user()->user_stat;
        $userStat->sound = ($userStat->sound == 0 ? 1 : 0);
        $userStat->save();
        return $userStat->sound == 0 ? 'Sound: off' : 'Sound: on';
    }

    public function changeName(Request $request)
    {
        $user = Auth::user();
        if (strlen($request->name) < 16) {
            $user->name = $request->name;
            $user->save();
            return 0;
        } else {
            return 1;
        }
    }

    public function changeHousesState(Request $request)
    {
        $user = Auth::user();
        $housesData = $request->houses;

        UserHouse::where('user_id', $user->id)->update(['position' => null]);

        $builtLast24h = UserHouse::where('user_id', $user->id)->where('created_at', '>',
            Carbon::now()->subHours(24)->toDateTimeString())->count();

        foreach ($housesData as $houseData) {
            $houseId = $houseData['id'];
            $housePosition = $houseData['position'];

            $userHouse = UserHouse::where([['user_id', $user->id], ['house_id', $houseId]])->first();

            if ($builtLast24h < 3 && empty($userHouse)) {
                $userHouse = new UserHouse();
                $userHouse->user_id = $user->id;
                $userHouse->house_id = $houseId;
                $userHouse->money_collected = Carbon::now();
                $userHouse->save();

                $builtLast24h++;
            }

            if (!empty($userHouse)) {
                $userHouse->position = $housePosition;
                $userHouse->save();
            }
        }

        $timeLeft = 0;
        if ($builtLast24h >= 3) {
            $lastHouseDate = $user->user_houses()->latest()->first()->created_at;
            $yesterday = Carbon::now()->subHours(24)->addSeconds(1);
            if ($lastHouseDate > $yesterday) {
                $timeLeft = $lastHouseDate->diffInSeconds($yesterday);
            }
        }

        return json_encode([
            'totalMoneyPerHour' => $user->user_stat->total_money_per_hour,
            'timeLeft' => $timeLeft
        ]);
    }

    public function getUserHouseInfo(Request $request)
    {
        $user = Auth::user();

        if (!isset($request->houseId)) {
            abort(403);
        }

        $houseId = $request->houseId;
        $userHouse = $user->user_houses()->where('house_id', $houseId)->first();

        if (empty($userHouse)) {
            abort(403);
        }

        // gather money
        $now = Carbon::now();
        if (!empty($userHouse->money_collected)) {
            $startPoint = $userHouse->money_collected;
        } else {
            $startPoint = $userHouse->created_at;
        }
        $secondsPassed = $now->diffInSeconds($startPoint);
        $moneyEarned = floor($userHouse->money_per_hour * $secondsPassed / 3600);
        if ($moneyEarned > $userHouse->max_money) {
            $moneyEarned = $userHouse->max_money;
        }

        $userStat = $user->user_stat;
        $lastMoney = $userStat->money;
        $userStat->money = $lastMoney + $moneyEarned;
        $userStat->save();

        $userHouse->money_collected = $now;
        $userHouse->money = $userHouse->money + $moneyEarned;
        $userHouse->save();

        // get tweets
        $tweets = $userHouse->house->tweets()
            ->orderBy('pub_date', 'desc')->orderBy('id', 'desc')->take($this::TWEETS_SHOW_COUNT + 1)->get();

        // mark as seen
        foreach ($tweets as $tweet) {
            $userReadTweet = $tweet->current_user_read();
            if (empty($userReadTweet)) {
                $userReadTweet = new UserReadTweet();
                $userReadTweet->user_id = $user->id;
                $userReadTweet->tweet_id = $tweet->id;
                $userReadTweet->status = 1;
                $userReadTweet->save();
            }
        }

        $html = view('partials.ajax_content.house', [
            'userHouse' => $userHouse,
            'pageSize' => ProfileController::TWEETS_SHOW_COUNT,
            'tweets' => $tweets
        ])->render();

        $output = json_encode([
            'money' => $userStat->money,
            'html' => $html,
            'newTweetCount' => $this->getNewTweetCount()
        ]);

        return $output;
    }

    public function getMoreTweets(Request $request)
    {
        if (empty($request->tweets) || $request->tweets >= ProfileController::MAX_TWEETS_SHOW_COUNT) {
            abort(403);
        }

        if (ProfileController::MAX_TWEETS_SHOW_COUNT - $request->tweets > ProfileController::TWEETS_SHOW_COUNT) {
            $tweetsToTake = ProfileController::TWEETS_SHOW_COUNT + 1;
        } else {
            $tweetsToTake = ProfileController::MAX_TWEETS_SHOW_COUNT - $request->tweets;
        }

        $user = Auth::user();

        if (!isset($request->houseId)) {
            abort(403);
        }

        $houseId = $request->houseId;
        $userHouse = $user->user_houses()->where('house_id', $houseId)->first();

        $tweets = $userHouse->house->tweets()
            ->orderBy('pub_date', 'desc')->orderBy('id', 'desc')->skip($request->tweets)
            ->take($tweetsToTake)->get();

        if (empty($tweets)) {
            abort(403);
        }

        // mark as seen
        foreach ($tweets as $tweet) {
            $userReadTweet = $tweet->current_user_read();
            if (empty($userReadTweet)) {
                $userReadTweet = new UserReadTweet();
                $userReadTweet->user_id = $user->id;
                $userReadTweet->tweet_id = $tweet->id;
                $userReadTweet->status = 1;
                $userReadTweet->save();
            }
        }

        $html = view('partials.ajax_content.more_userhouse_tweets', [
            'userHouse' => $userHouse,
            'tweets' => $tweets,
            'pageSize' => ProfileController::TWEETS_SHOW_COUNT,
        ])->render();

        return json_encode([
            'html' => $html
        ]);
    }

    public function getUserHouseInfoSmall(Request $request)
    {
        $user = Auth::user();

        if (!isset($request->houseId)) {
            abort(403);
        }

        $houseId = $request->houseId;
        $userHouse = $user->user_houses()->where('house_id', $houseId)->first();

        if (empty($userHouse)) {
            $house = House::where('id', $houseId)->first();
            if (!empty($house)) {
                $html = view('partials.ajax_content.house_small', ['house' => $house])->render();
                $output = json_encode(['html' => $html]);
            } else {
                abort(403);
            }
        } else {
            $html = view('partials.ajax_content.user_house_small', ['userHouse' => $userHouse])->render();
            $output = json_encode(['html' => $html]);
        }

        return $output;
    }

    public function gatherMoney(Request $request)
    {
        $user = Auth::user();

        if (!isset($request->houseId)) {
            abort(403);
        }

        $houseId = $request->houseId;
        $userHouse = $user->user_houses()->where('house_id', $houseId)->first();

        if (!empty($userHouse)) {
            $now = Carbon::now();
            if (!empty($userHouse->money_collected)) {
                $startPoint = $userHouse->money_collected;
            } else {
                $startPoint = $userHouse->created_at;
            }
            $secondsPassed = $now->diffInSeconds($startPoint);

            if ($secondsPassed > $this::SECONDS_TILL_NEXT_MONEY) {
                $moneyEarned = floor($userHouse->money_per_hour * $secondsPassed / 3600);
                if ($moneyEarned > $userHouse->max_money) {
                    $moneyEarned = $userHouse->max_money;
                }

                $userStat = $user->user_stat;
                $lastMoney = $userStat->money;
                $userStat->money = $lastMoney + $moneyEarned;
                $userStat->save();

                $userHouse->money_collected = $now;
                $userHouse->money = $userHouse->money + $moneyEarned;
                $userHouse->save();

                $output = json_encode([
                    'totalMoney' => $userStat->money,
                    'gatheredMoney' => $moneyEarned
                ]);
            } else {
                $output = 1;
            }
        } else {
            $output = 1;
        }

        return $output;
    }

    public function updateHouse(Request $request)
    {
        $user = Auth::user();

        if (!isset($request->updateId)) {
            abort(403);
        }

        $updateId = $request->updateId;

        $tweetUpdate = TweetUpdate::where('id', $updateId)->first();
        $userHouses = UserHouse::whereIn('house_id', $tweetUpdate->tweet->houses()->pluck('houses.id'))
            ->where('user_id', $user->id)->get();

        $housesToSend = [];
        if (!empty($tweetUpdate) && !empty($userHouses)) {
            foreach ($userHouses as $userHouse) {
                if (!$userHouse->user_house_updates()->where('tweet_update_id', $tweetUpdate->id)->exists()
                    && $tweetUpdate->actual_value > 0) {

                    $userHouseUpdate = new UserHouseUpdate();
                    $userHouseUpdate->tweet_update_id = $tweetUpdate->id;
                    $userHouseUpdate->user_house_id = $userHouse->id;
                    $userHouseUpdate->update_type_id = $tweetUpdate->update_type_id;
                    $userHouseUpdate->value = $tweetUpdate->actual_value;
                    $userHouseUpdate->save();

                    $housesToSend[] = [
                        'houseId' => $userHouse->house->id,
                        'houseMoney' => $userHouse->money_per_hour_text,
                        'houseCapacity' => $userHouse->max_money_text
                    ];
                }
            }
            $output = json_encode([
                'totalMoneyPerHour' => $user->user_stat->total_money_per_hour,
                'houses' => $housesToSend
            ]);
        } else {
            $output = 1;
        }

        return $output;
    }

    public function addToFav(Request $request)
    {
        $user = Auth::user();

        if (!isset($request->houseId)) {
            abort(403);
        }

        $houseId = $request->houseId;
        $userHouse = $user->user_houses()->where('house_id', $houseId)->first();

        if (!empty($userHouse)) {
            $userHouse->fav = $request['fav'] ? 1 : 0;
            $userHouse->save();

            $output = 0;
        } else {
            $output = 1;
        }

        return $output;
    }

    public function getAdv(Request $request)
    {
        $user = Auth::user();

        $builtLast24h = UserHouse::where('user_id', $user->id)->where('created_at', '>',
            Carbon::now()->subHours(24)->toDateTimeString())->get();

        foreach ($builtLast24h as $house) {
            $house->created_at = $house->created_at->subHours($this::HOURS_PER_ADV_CLICK);
            $house->save();
        }

        $adv = Adv::inRandomOrder()->first();

        $lastHouseDate = $user->user_houses()->latest()->first()->created_at;
        $yesterday = Carbon::now()->subHours(24);
        if ($lastHouseDate > $yesterday) {
            $timeLeft = $lastHouseDate->diffInSeconds($yesterday);
        } else {
            $timeLeft = 0;
        }

        $html = view('partials.ajax_content.adv', ['content' => $adv->content])->render();

        $output = json_encode([
            'html' => $html,
            'timeLeft' => $timeLeft
        ]);

        return $output;
    }

    public function updateAll()
    {
        $user = Auth::user();

        $userHouseIds = $user->user_houses()
            ->where('money_collected', '<', Carbon::now()->subSeconds($this::SECONDS_PER_MONEY_GATHER)
                ->toDateTimeString())->pluck('house_id');

        $output = json_encode([
            'houseIds' => $userHouseIds->toArray(),
            'newTweetCount' => $this->getNewTweetCount(),
            'next' => $this::SERVER_PING_TIME
        ]);
        return $output;
    }

    private function getNewTweetCount()
    {
        $user = Auth::user();
        $newTweetCount = 0;

        if (!empty($user)) {
            $lastTweetRead = $user->user_stat->last_tweet_read;

            if (empty($lastTweetRead)) {
                $newTweetCount = Tweet::orderBy('pub_date', 'desc')->orderBy('id', 'desc')->take(ProfileController::TWEETS_SHOW_COUNT)
                    ->whereDoesntHave('user_read_tweets', function ($query) {
                        $query->where('user_id', Auth::user()->id);
                    })->count();
            } else {
                $newTweetCount = Tweet::where('pub_date', '>', $lastTweetRead)
                    ->orderBy('pub_date', 'desc')->orderBy('id', 'desc')->take(ProfileController::TWEETS_SHOW_COUNT)
                    ->whereDoesntHave('user_read_tweets', function ($query) {
                        $query->where('user_id', Auth::user()->id);
                    })->count();
            }

            if ($newTweetCount > 99) {
                $newTweetCount = 99;
            }
        }

        return $newTweetCount;
    }

    public function getStats(Request $request)
    {
        $user = Auth::user();

        $html = view('partials.ajax_content.stats', ['userHouses' => $user->user_houses])->render();
        $output = json_encode(['html' => $html]);

        return $output;
    }

}
