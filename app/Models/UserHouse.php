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
        $updates = $this->tweet_updates()
            ->join('tweets', 'tweets.id', '=', 'tweet_updates.tweet_id')
            ->where('update_type_id','=', 1)
            ->addSelect('tweets.pub_date')
            ->addSelect('tweet_updates.value')
            ->get();

        $sum = $this->house->money_per_hour;

        foreach ($updates as $update) {
            $created_at = $update->pivot->created_at;
            $pub_date = $update->pub_date;

            $diffInDays = Carbon::createFromFormat('Y-m-d H:s:i', $pub_date)->diffInDays($created_at);

            if ($diffInDays >= 1 && $diffInDays < 7) {
                $sum += $update->value / 2;
            } else if ($diffInDays >= 7) {
                $sum += $update->value / 10;
            } else {
                $sum += $update->value;
            }
        }

        return $sum;
    }

    public function getMaxMoneyAttribute() {
        $updates = $this->tweet_updates()
            ->join('tweets', 'tweets.id', '=', 'tweet_updates.tweet_id')
            ->where('update_type_id','=', 2)
            ->addSelect('tweets.pub_date')
            ->addSelect('tweet_updates.value')
            ->get();

        $sum = $this->house->max_money;

        foreach ($updates as $update) {
            $created_at = $update->pivot->created_at;
            $pub_date = $update->pub_date;

            $diffInDays = Carbon::createFromFormat('Y-m-d H:s:i', $pub_date)->diffInDays($created_at);

            if ($diffInDays >= 1 && $diffInDays < 7) {
                $sum += $update->value / 2;
            } else if ($diffInDays >= 7) {
                $sum += $update->value / 10;
            } else {
                $sum += $update->value;
            }
        }

        return $sum;
    }

    public function getMoneyPerHourTextAttribute() {
        return number_format($this->money_per_hour, 0, '.', '.');
    }

    public function getMaxMoneyTextAttribute() {
        return number_format($this->max_money, 0, '.', '.');
    }
}
