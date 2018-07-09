<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserStat extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getMoneyAttribute($value) {
        return number_format($value, 0, '.', '.');
    }

    public function getSoundTextAttribute() {
        return $this->sound == 0 ? 'off' : 'on';
    }

    public function getTotalMoneyPerHourAttribute() {
        $result = DB::table('user_houses')
            ->join('houses', 'user_houses.house_id', '=', 'houses.id')
            ->where('user_houses.user_id', $this->user->id)
            ->sum('money_per_hour');
        return $result;
    }
}
