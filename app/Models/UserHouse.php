<?php

namespace App\Models;

use App\Http\Controllers\User\ProfileController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserHouse extends Model
{
    protected $dates = ['money_collected'];

    protected $casts = [
        'fav' => 'boolean'
    ];

    public function house() {
        return $this->belongsTo('App\Models\House');
    }

    public function tweet_updates() {
        return $this->belongsToMany('App\Models\TweetUpdate', 'user_house_updates')
            ->withTimestamps();
    }

    public function user_house_updates() {
        return $this->hasMany('App\Models\UserHouseUpdate');
    }

    public function canGatherMoney() {
        if (!empty($this->money_collected)) {
            $startPoint = $this->money_collected;
        } else {
            $startPoint = $this->created_at;
        }
        $secondsPassed = Carbon::now()->diffInSeconds($startPoint);

        return $secondsPassed >= ProfileController::SECONDS_PER_MONEY_GATHER;
    }

    public function getMoneyPerHourAttribute() {
        $updatesSum = $this->user_house_updates()->where('update_type_id','=', 1)->sum('value');
        return $this->house->money_per_hour + $updatesSum;
    }

    public function getMaxMoneyAttribute() {
        $updatesSum = $this->user_house_updates()->where('update_type_id','=', 2)->sum('value');
        return $this->house->max_money + $updatesSum;
    }

    public function getMoneyPerHourTextAttribute() {
        return number_format($this->money_per_hour, 0, '.', '.');
    }

    public function getMaxMoneyTextAttribute() {
        return number_format($this->max_money, 0, '.', '.');
    }
}
