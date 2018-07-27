<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TweetUpdate extends Model
{
    public function update_type() {
        return $this->belongsTo('App\Models\UpdateType');
    }

    public function tweet() {
        return $this->belongsTo('App\Models\Tweet');
    }

    public function user_houses() {
        return $this->belongsToMany('App\Models\UserHouse', 'user_house_updates');
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
