<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserStat extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getSoundTextAttribute() {
        return $this->sound == 0 ? 'off' : 'on';
    }

    public function getTotalMoneyPerHourAttribute() {
        $user_houses = $this->user->user_houses;
        $sum = 0;
        foreach ($user_houses as $user_house) {
            $sum += $user_house->money_per_hour;
        }
        return number_format($sum, 0, '.', ' ');
    }
}
