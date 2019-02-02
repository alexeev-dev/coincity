<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tweet extends Model
{
    protected $fillable = ['title', 'description', 'link', 'alias', 'content', 'introtext', 'pub_date'];
    protected $dates = ['pub_date'];

    public function tweet_updates()
    {
        return $this->hasMany('App\Models\TweetUpdate');
    }

    public function houses()
    {
        return $this->belongsToMany('App\Models\House', 'tweet_assignments');
    }

    public function is_unseen()
    {
        $user = Auth::user();

        if (empty($user)) {
            return true;
        }

        return $this->pub_date > $user->user_stat->last_tweet_read;
    }

    public function getTimeLeftAttribute()
    {
        $expires_at = $this->pub_date->addHours(24);
        $now = Carbon::now();

        $output = '';
        if ($expires_at > $now) {
            $output .= gmdate('H:i:s', $expires_at->diffInSeconds($now));
        }
        return $output;
    }

    public function getIsHouseBuiltAttribute()
    {
        $userId = Auth::user()->id;
        $houses = $this->houses;
        foreach ($houses as $house) {
            if (count($house->user_houses()->where('user_id', $userId)->get())) {
                return true;
            }
        }
        return false;
    }

    public function getIsOldAttribute()
    {
        return $this->pub_date < Carbon::now()->subDays(7);
    }

    public function setPubDateAttribute($value)
    {
        if (!empty($value)) {
            $value = Carbon::createFromFormat('d.m.Y', $value);
            $this->attributes['pub_date'] = ($value->format('Y-m-d H:i:s'));
        } else {
            $this->attributes['pub_date'] = Carbon::now();
        }
    }

    public function getFormattedDateAttribute()
    {
        return $this->pub_date->format('d.m.Y');
    }
}
