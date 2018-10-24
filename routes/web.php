<?php

use Illuminate\Support\Facades\Route;

App::setLocale('ru');

Route::get('/', 'HomeController@index')->name('home');
Route::post('/page/{alias}', 'HomeController@getPage');
Route::post('/news', 'HomeController@getNews');
Route::post('/more-news', 'HomeController@moreNews');
Route::get('/news/{alias}', 'HomeController@singleNews');

Route::get('/admin', 'Admin\AdminController@index')->name('admin');
Route::post('/admin', 'Admin\AdminController@update')->name('admin_update');
Route::get('/editor', 'Admin\AdminController@editor');

Route::group([ 'prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::post('switch-sound', 'User\ProfileController@switchSound');
    Route::post('change-name', 'User\ProfileController@changeName');
    Route::post('change-houses-state', 'User\ProfileController@changeHousesState');

    Route::post('get-user-house-info', 'User\ProfileController@getUserHouseInfo');
    Route::post('get-more-tweets', 'User\ProfileController@getMoreTweets');

    Route::post('get-user-house-info-small', 'User\ProfileController@getUserHouseInfoSmall');
    Route::post('gather-money', 'User\ProfileController@gatherMoney');
    Route::post('update-house', 'User\ProfileController@updateHouse');
    Route::post('add-to-fav', 'User\ProfileController@addToFav');

    Route::post('adv', 'User\ProfileController@getAdv');
    Route::post('update-all', 'User\ProfileController@updateAll');

    Route::post('stats', 'User\ProfileController@getStats');
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





