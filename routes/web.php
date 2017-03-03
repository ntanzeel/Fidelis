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
Route::group(['as' => 'auth.'], function () {

    /*
     * Login Routes
     */
    Route::get('login', [
        'as'   => 'login',
        'uses' => 'Auth\LoginController@index',
    ]);

    Route::post('login', [
        'as'   => 'login',
        'uses' => 'Auth\LoginController@login',
    ]);

    /*
     * Logout Routes
     */
    Route::get('logout', [
        'as'   => 'logout',
        'uses' => 'Auth\LoginController@logout',
    ]);

    /*
     * Registration Routes
     */
    Route::get('register', [
        'as'   => 'register',
        'uses' => 'Auth\RegisterController@index',
    ]);

    Route::post('register', [
        'as'   => 'register',
        'uses' => 'Auth\RegisterController@register',
    ]);

    /*
     * Password Reset Routes
     */
    Route::get('password/reset', [
        'as'   => 'password.request',
        'uses' => 'Auth\Password\ForgotController@index',
    ]);

    Route::post('password/email', [
        'as'   => 'password.email',
        'uses' => 'Auth\Password\ForgotController@sendResetLinkEmail',
    ]);

    Route::get('password/reset/{token}', [
        'as'   => 'password.change',
        'uses' => 'Auth\Password\ResetController@index',
    ]);
    Route::post('password/reset', [
        'as'   => 'password.reset',
        'uses' => 'Auth\Password\ResetController@reset',
    ]);
});

/*
 * Pages
 */
Route::group(['as' => 'pages.'], function () {
    Route::get('/', [
        'as'   => 'index',
        'uses' => 'PagesController@index',
    ]);
});

/*
 * Home
 */
Route::group(['as' => 'home.'], function () {
    Route::get('home', [
        'as'   => 'index',
        'uses' => 'HomeController@index',
    ]);
});

/*
 * Discover
 */
Route::group(['as' => 'discover.'], function () {
    Route::get('discover', [
        'as'   => 'index',
        'uses' => 'DiscoverController@index',
    ])->middleware('auth');

    Route::get('discover/{category}', [
        'as'   => 'category',
        'uses' => 'DiscoverController@category',
    ]);
});

/*
 * Notifications
 */
Route::group(['as' => 'notifications.'], function () {
    Route::get('notifications', [
        'as'   => 'index',
        'uses' => 'NotificationsController@index',
    ]);
});

/*
 * Posts
 */
Route::group(['as' => 'post.'], function () {
    Route::get('@{user}/post/{post}', [
        'as'   => 'view',
        'uses' => 'PostsController@view',
    ]);
});

/*
 * User
 */
Route::group(['as' => 'profile.'], function () {
    Route::get('@{user}', [
        'as'   => 'view',
        'uses' => 'ProfileController@view',
    ]);

    Route::get('@{user}/followers', [
        'as'   => 'followers',
        'uses' => 'ProfileController@followers',
    ]);

    Route::get('@{user}/following', [
        'as'   => 'following',
        'uses' => 'ProfileController@following',
    ]);

    Route::get('@{user}/rated', [
        'as'   => 'rated',
        'uses' => 'ProfileController@rated',
    ]);
});

/*
 * Settings
 */
Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {

    /*
     * Account
     */
    Route::group(['as' => 'account.'], function () {
        Route::get('/account', [
            'as'   => 'index',
            'uses' => 'Settings\AccountController@index',
        ]);

        Route::post('upload_profile_pic', [
            'as'   => 'upload_profile_pic',
            'uses' => 'Settings\AccountController@upload_profile_pic',
        ]);

        Route::post('upload_cover_pic', [
            'as'   => 'upload_cover_pic',
            'uses' => 'Settings\AccountController@upload_cover_pic',
        ]);

        Route::post('edit_profile', [
            'as'   => 'edit_profile',
            'uses' => 'Settings\AccountController@edit_profile',
        ]);
    });

    /*
     * Subscriptions
     */
    Route::group(['as' => 'subscriptions.'], function () {
        Route::get('/subscriptions', [
            'as'   => 'index',
            'uses' => 'Settings\SubscriptionsController@index',
        ]);

    });

    /*
     * Safety
     */
    Route::group(['as' => 'safety.'], function () {
        Route::get('/safety', [
            'as'   => 'index',
            'uses' => 'Settings\SafetyController@index',
        ]);

        Route::post('/safety', [
            'as'   => 'store',
            'uses' => 'Settings\SafetyController@store',
        ]);
    });

    /*
     * Safety
     */
    Route::group(['as' => 'blocked.', 'prefix' => 'blocked'], function () {
        Route::get('/', [
            'as'   => 'index',
            'uses' => 'Settings\BlockedController@index',
        ]);
    });
});

/*
 * API
 */
Route::group(['as' => 'api.', 'prefix' => 'api', 'middleware' => 'ajax'], function () {
    /*
     * Posts
     */
    Route::group(['as' => 'post.', 'prefix' => 'post'], function () {
        Route::get('/', [
            'as'   => 'index',
            'uses' => 'Api\PostController@index',
        ]);

        Route::get('/create', [
            'as'   => 'index',
            'uses' => 'Api\PostController@index',
        ]);

        Route::post('/', [
            'as'   => 'store',
            'uses' => 'Api\PostController@store',
        ]);

        Route::get('/{post}', [
            'as'   => 'show',
            'uses' => 'Api\PostController@show',
        ]);

        Route::delete('/{post}', [
            'as'   => 'delete',
            'uses' => 'Api\PostController@destroy',
        ]);
    });

    /*
     * Subscriptions
     */
    Route::group(['as' => 'subscription.', 'prefix' => 'subscription'], function () {
        Route::post('/', [
            'as'   => 'store',
            'uses' => 'Api\SubscriptionsController@store',
        ]);

        Route::delete('/{tag}', [
            'as'   => 'delete',
            'uses' => 'Api\SubscriptionsController@delete',
        ]);
    });

    /*
     * Comments
     */
    Route::group(['as' => 'comment.', 'prefix' => '/post/{post}/comment'], function () {
        Route::post('/', [
            'as'   => 'store',
            'uses' => 'Api\CommentController@store',
        ]);

        Route::delete('/{comment}', [
            'as'   => 'delete',
            'uses' => 'Api\CommentController@delete',
        ]);

        Route::get('/', [
            'as'   => 'show',
            'uses' => 'Api\CommentController@show',
        ]);
    });

    /*
     * Votes
     */
    Route::group(['as' => 'vote.', 'prefix' => '/comment/{comment}/vote'], function () {
        Route::post('/', [
            'as'   => 'store',
            'uses' => 'Api\VoteController@store',
        ]);

        Route::post('/{vote}', [
            'as'   => 'delete',
            'uses' => 'Api\VoteController@delete',
        ]);
    });

    /*
     * Reports
     */
    Route::group(['as' => 'report.', 'prefix' => '/comment/{comment}/report'], function () {
        Route::post('/', [
            'as'   => 'store',
            'uses' => 'Api\ReportController@store',
        ]);

        Route::post('/{report}', [
            'as'   => 'delete',
            'uses' => 'Api\ReportController@delete',
        ]);
    });

    /*
     * Following
     */
    Route::group(['as' => 'follower.', 'prefix' => 'follower'], function () {
        Route::post('/', [
            'as'   => 'store',
            'uses' => 'Api\FollowersController@store',
        ]);

        Route::delete('/{user}', [
            'as'   => 'delete',
            'uses' => 'Api\FollowersController@delete',
        ]);

    });

    /*
     * Blocked
     */
    Route::group(['as' => 'blocked.', 'prefix' => 'blocked'], function () {
        Route::post('/', [
            'as'   => 'store',
            'uses' => 'Api\BlockedController@store',
        ]);

        Route::delete('/{user}', [
            'as'   => 'delete',
            'uses' => 'Api\BlockedController@delete',
        ]);

    });
});