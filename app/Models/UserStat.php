<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserStat extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getMoneyTextAttribute() {
        return number_format($this->money, 0, '.', '.');
    }

    public function getSoundTextAttribute() {
        return $this->sound == 0 ? 'off' : 'on';
    }

    public function getTotalMoneyPerHourAttribute() {
        return $this->user->user_houses->sum('money_per_hour');
    }
}
