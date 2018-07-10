<?php

use Illuminate\Support\Facades\Route;

App::setLocale('ru');

Route::get('/', 'HomeController@index')->name('home');

Route::group([ 'prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::post('switch-sound', 'User\ProfileController@switchSound');
    Route::post('change-name', 'User\ProfileController@changeName');
    Route::post('change-houses-state', 'User\ProfileController@changeHousesState');

    Route::post('get-user-house-info', 'User\ProfileController@getUserHouseInfo');
    Route::post('get-user-house-info-small', 'User\ProfileController@getUserHouseInfoSmall');
    Route::post('gather-money', 'User\ProfileController@gatherMoney');
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



