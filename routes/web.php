<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*
 * Authentication
 */
Route::group(['as' => 'auth.'], function() {

    /*
     * Login Routes
     */
    Route::get('login', [
        'as'    => 'login',
        'uses'  => 'Auth\LoginController@showLoginForm'
    ]);

    Route::post('login', [
        'as'    => 'login',
        'uses'  => 'Auth\LoginController@login'
    ]);

    /*
     * Logout Routes
     */
    Route::get('logout', [
        'as'    => 'logout',
        'uses'  => 'Auth\LoginController@logout'
    ]);

    /*
     * Registration Routes
     */
    Route::get('register', [
        'as'    => 'register',
        'uses'  => 'Auth\RegisterController@showRegistrationForm'
    ]);

    Route::post('register', [
        'as'    => 'register',
        'uses'  => 'Auth\RegisterController@register'
    ]);

    /*
     * Password Reset Routes
     */
    Route::get('password/reset', [
        'as'    => 'password.request',
        'uses'  => 'Auth\ForgotPasswordController@showLinkRequestForm'
    ]);

    Route::post('password/email', [
        'as'    => 'password.email',
        'uses'  => 'Auth\ForgotPasswordController@sendResetLinkEmail'
    ]);

    Route::get('password/reset/{token}', [
        'as'    => 'password.change',
        'uses'  => 'Auth\ResetPasswordController@showResetForm'
    ]);
    Route::post('password/reset', [
        'as'    => 'password.reset',
        'uses'  => 'Auth\ResetPasswordController@reset'
    ]);
});

/*
 * Pages
 */
Route::group(['as' => 'pages.'], function() {
    Route::get('/', [
        'as'    => 'index',
        'uses'  => 'PagesController@index'
    ]);
});

/*
 * Home
 */
Route::group(['as' => 'home.'], function() {
    Route::get('home', [
        'as'    => 'index',
        'uses'  => 'HomeController@index'
    ]);
});

/*
 * Discover
 */

Route::group(['as' => 'discover.'], function() {
    Route::get('discover', [
        'as'    => 'index',
        'uses'  => 'DiscoverController@index'
    ]);

    Route::get('discover/{category}', [
        'as'    => 'category',
        'uses'  => 'DiscoverController@category'
    ]);
});
