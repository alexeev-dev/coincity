<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TweetUpdate extends Model
{
    protected $fillable = ['tweet_id', 'update_type_id', 'value'];

    public function tweet() {
        return $this->belongsTo('App\Models\Tweet');
    }

    public function user_houses() {
        return $this->belongsToMany('App\Models\UserHouse', 'user_house_updates');
    }

    public function current_user_houses() {
        return $this->user_houses()->where('user_id', Auth::user()->id)->get();
    }

    public function getActualValueAttribute() {
        $tweetDate = $this->tweet->pub_date;
        $diffInDays = Carbon::now()->diffInDays($tweetDate);

        if ($diffInDays >= 1 && $diffInDays < 7) {
            $output = $this->value / 2;
        } else if ($diffInDays >= 7) {
            $output = $this->value / 10;
        } else {
            $output = $this->value;
        }
        return $output;
    }

    public function getUpdateClassAttribute() {
        $output = '';
        switch ($this->update_type_id) {
            case 1:
            case 3:
                $output .= ' cointime';
                break;
            case 2:
                $output .= ' coinmax';
                break;
        }
        return $output;
    }

    public function getValueTextAttribute() {
        $output = '';
        switch ($this->update_type_id) {
            case 1:
            case 2:
                $output .= '+';
                break;
            case 3:
                $output .= 'x';
                break;
        }
        return $output.$this->actual_value;
    }
}
