<?php

use Illuminate\Support\Facades\Route;

App::setLocale('ru');

Route::get('/', 'HomeController@index')->name('home');

Route::group([ 'prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('profile', 'User\ProfileController@index')->name('profile');
    Route::post('update', 'User\ProfileController@update')->name('update_profile');
});

Auth::routes();

Route::group([ 'prefix' => 'register', 'middleware' => 'guest'], function() {
    Route::get('resend-verification', 'Auth\RegisterController@verification')->name('resend_verification');
    Route::post('resend-verification', 'Auth\RegisterController@resendVerification')->name('resend_verification');
    Route::get('verify/{confirmationCode}', 'Auth\RegisterController@confirm')->name('verify_email');
    Route::get('verification-code-sent', function() {
        return view('auth.verification_sent');
    });
    Route::get('verified', function() {
        return view('auth.verified');
    });
});



