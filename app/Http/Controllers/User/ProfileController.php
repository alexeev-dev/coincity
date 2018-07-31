<?php

namespace App\Http\Controllers\User;

use App\Models\UserHouseUpdate;
use App\Models\TweetUpdate;
use App\Models\House;
use App\Models\UserHouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function switchSound() {
        $userStat = Auth::user()->user_stat;
        $userStat->sound = ($userStat->sound == 0 ? 1 : 0);
        $userStat->save();
        return $userStat->sound == 0 ? 'Sound: off': 'Sound: on';
    }

    public function changeName(Request $request) {
        $user = Auth::user();
        if (strlen($request['name']) < 16) {
            $user->name = $request['name'];
            $user->save();
            return 0;
        } else {
            return 1;
        }
    }

    public function changeHousesState(Request $request) {
        $user = Auth::user();
        $housesData = $request['houses'];

        UserHouse::where('user_id', $user->id)->update(['position' => null]);

        foreach ($housesData as $houseData) {
            $houseId = $houseData['id'];
            $housePosition = $houseData['position'];

            $userHouse = UserHouse::where([['user_id', $user->id], ['house_id', $houseId]])->first();
            if (empty($userHouse)) {
                $userHouse = new UserHouse();
                $userHouse->user_id = $user->id;
                $userHouse->house_id = $houseId;
                $userHouse->save();
            }

            $userHouse->position = $housePosition;
            $userHouse->save();
        }

        return json_encode(['totalMoneyPerHour' => $user->user_stat->total_money_per_hour]);
    }

    public function getUserHouseInfo(Request $request) {
        $user = Auth::user();
        $houseId = $request['houseId'];

        $userHouse = $user->user_houses()->where('house_id', $houseId)->first();
        if (!empty($userHouse)) {

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
            $userHouse->save();

            // get tweets
            $tweets = $userHouse->house->tweets;
            $html = view('partials.house', ['userHouse' => $userHouse, 'tweets' => $tweets])->render();
            $output = json_encode(['money' => $userStat->money_text, 'html' => $html]);
        } else {
            $html = view('partials.error')->render();
            $output = json_encode(['html' => $html]);
        }

        return $output;
    }

    public function getUserHouseInfoSmall(Request $request) {
        $user = Auth::user();
        $houseId = $request['houseId'];

        $userHouse = $user->user_houses()->where('house_id', $houseId)->first();
        if (!empty($userHouse)) {
            $html = view('partials.user_house_small', ['userHouse' => $userHouse])->render();
            $output = json_encode(['html' => $html]);
        } else {
			$house = House::where('id', $houseId)->first();
			if (!empty($house)) {
				$html = view('partials.house_small', ['house' => $house])->render();
				$output = json_encode(['html' => $html]);
			} else {
				$html = view('partials.error')->render();
				$output = json_encode(['html' => $html]);
			}				
        }

        return $output;
    }

    public function gatherMoney(Request $request) {
        $user = Auth::user();
        $houseId = $request['houseId'];

        $userHouse = $user->user_houses()->where('house_id', $houseId)->first();
        if (!empty($userHouse)) {
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
            $userHouse->save();

            $output = json_encode(['money' => $userStat->money_text]);
        } else {
            $output = 1;
        }

        return $output;
    }

    public function updateHouse(Request $request) {
        $user = Auth::user();
        $updateId = $request['updateId'];

        $tweetUpdate = TweetUpdate::where('id', $updateId)->first();
        $userHouses = UserHouse::whereIn('house_id', $tweetUpdate->tweet->houses()->pluck('houses.id'))
            ->where('user_id', $user->id)->get();

        $housesToSend = [];
        if (!empty($tweetUpdate) && !empty($userHouses)) {
            foreach ($userHouses as $userHouse) {
                if (!$userHouse->user_house_updates()->where('tweet_update_id', $tweetUpdate->id)->exists()) {
                    $userHouseUpdate = new UserHouseUpdate();
                    $userHouseUpdate->tweet_update_id = $tweetUpdate->id;
                    $userHouseUpdate->user_house_id = $userHouse->id;
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
}
