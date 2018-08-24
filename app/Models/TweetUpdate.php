<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TweetUpdate extends Model
{
    protected $fillable = ['tweet_id', 'update_type_id', 'value'];

    public function update_type() {
        return $this->belongsTo('App\Models\UpdateType');
    }

    public function tweet() {
        return $this->belongsTo('App\Models\Tweet');
    }

    public function user_houses() {
        return $this->belongsToMany('App\Models\UserHouse', 'user_house_updates');
    }

    public function current_user_houses() {
        return $this->user_houses()->where('user_id', Auth::user()->id)->get();
    }

    public function getUpdateClassAttribute() {
        $output = '';
        switch ($this->update_type->id) {
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
        switch ($this->update_type->id) {
            case 1:
            case 2:
                $output .= '+';
                break;
            case 3:
                $output .= 'x';
                break;
        }
        return $output.$this->value;
    }
}
