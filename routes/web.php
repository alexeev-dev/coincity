<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

App::setLocale('en');

Route::get('/', 'HomeController@index')->name('home');
Route::post('/news', 'HomeController@getNews');
Route::post('/more-news', 'HomeController@moreNews');

Route::get('/page/{alias}', 'HomeController@getPage');
Route::get('/news/{alias}', 'HomeController@singleNews');

Route::post('/feedback', 'HomeController@sendFeedback');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
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

Route::group(['prefix' => 'register', 'middleware' => 'guest'], function() {
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

Route::get('/admin', 'Admin\Auth\LoginController@showLoginForm');
Route::post('/admin', 'Admin\Auth\LoginController@login')->name('admin_login');
Route::get('/admin_logout', 'Admin\Auth\LoginController@logout')->name('admin_logout');

Route::group([ 'prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin_dashboard');

    Route::get('loader', 'Admin\LoaderController@index')->name('admin_loader');
    Route::post('loader', 'Admin\LoaderController@update')->name('admin_loader_update');

    Route::get('editor', 'Admin\DashboardController@editor')->name('admin_editor');;
});




