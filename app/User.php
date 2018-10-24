<?php

namespace App;

use App\Mail\EmailConfirmation;
use App\Mail\EmailResetPassword;
use App\Models\UserStat;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    protected static function boot() {
        parent::boot();

        static::created(function($user){
            if (empty($user->user_stat)) {
                $userStat = new UserStat();
                $userStat->user_id = $user->id;
                $userStat->save();
            }

            if (!$user->confirmed) {
                $user->sendConfirmation();
            }
        });
    }

    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code', 'confirmed'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_stat() {
        return $this->hasOne('App\Models\UserStat');
    }

    public function user_houses() {
        return $this->hasMany('App\Models\UserHouse');
    }

    public function sendPasswordResetNotification($token) {
        Mail::to($this->email)->send(new EmailResetPassword($token));
    }

    public function sendConfirmation() {
        Mail::to($this->email)->send(new EmailConfirmation($this->confirmation_code));
    }
}
