<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHouse extends Model
{
    protected $dates = ['money_collected'];

    public function house() {
        return $this->belongsTo('App\Models\House');
    }

    public function tweet_updates() {
        return $this->belongsToMany('App\Models\TweetUpdate', 'user_house_updates');
    }

    public function user_house_updates() {
        return $this->hasMany('App\Models\UserHouseUpdate');
    }

    public function getMoneyPerHourAttribute() {
        $updatesSum = $this->tweet_updates()->where('update_type_id','=', 1)->sum('value');
        return $this->house->money_per_hour + $updatesSum;
    }

    public function getMaxMoneyAttribute() {
        $updatesSum = $this->tweet_updates()->where('update_type_id','=', 2)->sum('value');
        return $this->house->max_money + $updatesSum;
    }

    public function getMoneyPerHourTextAttribute() {
        return number_format($this->money_per_hour, 0, '.', '.');
    }

    public function getMaxMoneyTextAttribute() {
        return number_format($this->max_money, 0, '.', '.');
    }
}
