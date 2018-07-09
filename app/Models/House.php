<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    public function tweets() {
        return $this->belongsToMany('App\Models\House', 'tweet_assignments');
    }

    public function user_houses() {
        return $this->hasMany('App\Models\UserHouse');
    }

    public function getMoneyPerHourAttribute($value) {
        return number_format($value, 0, '.', '.');
    }
}
