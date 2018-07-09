<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tweet extends Model
{
    protected $dates = ['pub_date'];

    public function tweet_update() {
        return $this->hasOne('App\Models\TweetUpdate');
    }

    public function houses() {
        return $this->belongsToMany('App\Models\House', 'tweet_assignments');
    }

    public function getTimeLeftAttribute() {
        $expires_at = $this->pub_date->addHours(24);
        $now = Carbon::now();

        $output = '';
        if ($now->diffInSeconds($expires_at) > 0) {
            $output .= gmdate('H:i:s', $now->diffInSeconds($expires_at));;
        }
        return $output;
    }

    public function getIsHouseBuiltAttribute() {
        $userId = Auth::user()->id;
        $houses = $this->houses;
        foreach ($houses as $house) {
            if (count($house->user_houses()->where('user_id', $userId)->get())) {
                return true;
            }
        }
        return false;
    }
}
