<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
Route::get('/logout', 'Auth\LoginController@logout');

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

Route::get('/admin', 'Admin\Auth\LoginController@showLoginForm')->name('admin_login');
Route::post('/admin', 'Admin\Auth\LoginController@login')->name('admin_login');
Route::get('/admin_logout', 'Admin\Auth\LoginController@logout')->name('admin_logout');

Route::group([ 'prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin_dashboard');

    Route::get('loader', 'Admin\LoaderController@index')->name('admin_loader');
    Route::post('loader', 'Admin\LoaderController@update')->name('admin_loader_update');

    Route::get('editor', 'Admin\DashboardController@editor')->name('admin_editor');

    // adv
    Route::get('adv/list', 'Admin\AdvController@index')->name('admin-adv');
    Route::get('adv/add', 'Admin\AdvController@add')->name('admin-adv-add');
    Route::post('adv/add', 'Admin\AdvController@save')->name('admin-adv-save');
    Route::get('adv/{adv_id}/edit', 'Admin\AdvController@edit')->name('admin-adv-edit');
    Route::post('adv/{adv_id}/edit', 'Admin\AdvController@update')->name('admin-adv-update');
    Route::get('adv/{adv_id}/delete', 'Admin\AdvController@delete')->name('admin-adv-delete');

    // house
    Route::get('house/list', 'Admin\HouseController@index')->name('admin-house');
    Route::get('house/add', 'Admin\HouseController@add')->name('admin-house-add');
    Route::post('house/add', 'Admin\HouseController@save')->name('admin-house-save');
    Route::get('house/{house_id}/edit', 'Admin\HouseController@edit')->name('admin-house-edit');
    Route::post('house/{house_id}/edit', 'Admin\HouseController@update')->name('admin-house-update');
    Route::get('house/{house_id}/delete', 'Admin\HouseController@delete')->name('admin-house-delete');

    // tweet
    Route::get('tweet/list', 'Admin\TweetController@index')->name('admin-tweet');
    Route::get('tweet/add', 'Admin\TweetController@add')->name('admin-tweet-add');
    Route::post('tweet/add', 'Admin\TweetController@save')->name('admin-tweet-save');
    Route::get('tweet/{tweet_id}/edit', 'Admin\TweetController@edit')->name('admin-tweet-edit');
    Route::post('tweet/{tweet_id}/edit', 'Admin\TweetController@update')->name('admin-tweet-update');
    Route::get('tweet/{tweet_id}/delete', 'Admin\TweetController@delete')->name('admin-tweet-delete');
});

// ******** socialite ********
Route::get('/socialite/{provider}', ['as' => 'socialite.auth',
    function ($provider) {
        return Socialite::driver($provider)->redirect();
    }
]);
Route::get('/socialite/{provider}/callback', 'Auth\SocialController@process');