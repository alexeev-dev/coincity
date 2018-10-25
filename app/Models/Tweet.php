<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tweet extends Model
{
    protected $fillable = ['title', 'description', 'link', 'alias', 'content', 'introtext', 'pub_date'];
    protected $dates = ['pub_date'];

    public function tweet_update() {
        return $this->hasOne('App\Models\TweetUpdate');
    }

    public function houses() {
        return $this->belongsToMany('App\Models\House', 'tweet_assignments');
    }

    public function user_read_tweets() {
        return $this->hasMany('App\Models\UserReadTweet');
    }

    public function current_user_read() {
        return $this->user_read_tweets()->where('user_id', Auth::user()->id)->first();
    }

    public function is_unseen() {
        $user = Auth::user();

        if (empty($user)) {
            return true;
        }

        return empty($this->current_user_read()) && $this->pub_date > $user->user_stat->last_tweet_read;
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

    public function setPubDateAttribute($value)
    {
        if (!empty($value)) {
            $value = DateTime::createFromFormat('d.m.Y', $value);
            $this->attributes['pub_date'] = ($value->format('Y-m-d H:i:s'));
        } else {
            $this->attributes['pub_date'] = new DateTime();
        }
    }
}
