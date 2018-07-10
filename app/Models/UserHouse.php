<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHouse extends Model
{
    protected $dates = ['money_collected'];

    public function house() {
        return $this->belongsTo('App\Models\House');
    }

    public function getMoneyPerHourAttribute() {
        // todo add money updates here
        return $this->house->money_per_hour;
    }

    public function getMaxMoneyAttribute() {
        // todo add money updates here
        return $this->house->max_money;
    }

    public function getMoneyPerHourTextAttribute() {
        return number_format($this->money_per_hour, 0, '.', '.');
    }

    public function getMaxMoneyTextAttribute() {
        return number_format($this->max_money, 0, '.', '.');
    }
}
