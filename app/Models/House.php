<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = ['name', 'icon', 'image', 'image_small', 'max_money', 'money_per_hour',
        'title', 'description', 'content'];

    public function tweets()
    {
        return $this->belongsToMany('App\Models\Tweet', 'tweet_assignments');
    }

    public function user_houses()
    {
        return $this->hasMany('App\Models\UserHouse');
    }

    public function getMoneyPerHourTextAttribute()
    {
        return number_format($this->money_per_hour, 0, '.', ' ');
    }

    public function getMaxMoneyTextAttribute()
    {
        return number_format($this->max_money, 0, '.', ' ');
    }

    public function getLastUpdates()
    {
        $lastTweet = $this->tweets()->has('tweet_updates')->orderBy('pub_date', 'DESC')
            ->take(1)->first();
        return empty($lastTweet) ? null : $lastTweet->tweet_updates;
    }

    public function getLastUpdateTextAttribute()
    {
        $lastUpdates = $this->getLastUpdates();
        $upd = [];
        if (!empty($lastUpdates)) {
            foreach ($lastUpdates as $update) {
                $upd[] = $update->prefix_value;
            }
        }
        return count($upd) > 0 ? implode(', ', $upd) : '';
    }
}
