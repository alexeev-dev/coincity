<?php

namespace App;

use App\Mail\EmailConfirmation;
use App\Mail\EmailResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    protected static function boot() {
        parent::boot();

        static::created(function($user){
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

    public function sendPasswordResetNotification($token) {
        Mail::to($this->email)->queue(new EmailResetPassword($token));
    }

    public function sendConfirmation() {
        Mail::to($this->email)->queue(new EmailConfirmation($this->confirmation_code));
    }
}
