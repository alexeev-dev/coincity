<?php

namespace App\Http\Controllers\User;

use App\Models\UserHouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        UserHouse::query()->update(['position' => null]);

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

        return json_encode(['total_money_per_hour' => $user->user_stat->total_money_per_hour]);
    }
}
