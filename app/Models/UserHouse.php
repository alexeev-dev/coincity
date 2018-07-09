<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHouse extends Model
{
    public function house() {
        return $this->belongsTo('App\Models\House');
    }

    public function getMoneyPerHourAttribute() {
        return number_format($this->house->money_per_hour, 0, '.', '.');
    }
}
