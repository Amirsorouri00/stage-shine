<?php

use App\Constants\Endpoints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['cors', 'json.response', 'auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // ...

    // public routes
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
//    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
});

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');

    Route::get(Endpoints::STAGESHINE_EVENTS_PANEL_INDEX['endpoint'],Endpoints::STAGESHINE_EVENTS_PANEL_INDEX['class']);
    Route::apiResource(Endpoints::STAGESHINE_EVENTS['endpoint'],Endpoints::STAGESHINE_EVENTS['class']);

    Route::get(Endpoints::STAGESHINE_CATEGORIES_PANEL_INDEX['endpoint'],Endpoints::STAGESHINE_CATEGORIES_PANEL_INDEX['class']);
    Route::apiResource(Endpoints::STAGESHINE_CATEGORIES['endpoint'],Endpoints::STAGESHINE_CATEGORIES['class']);

    Route::get(Endpoints::STAGESHINE_CHANNELS_PANEL_INDEX['endpoint'],Endpoints::STAGESHINE_CHANNELS_PANEL_INDEX['class']);
    Route::apiResource(Endpoints::STAGESHINE_CHANNELS['endpoint'],Endpoints::STAGESHINE_CHANNELS['class']);

    Route::get(Endpoints::STAGESHINE_CHANNEL_FOLLOWERS_PANEL_INDEX['endpoint'],Endpoints::STAGESHINE_CHANNEL_FOLLOWERS_PANEL_INDEX['class']);
    Route::apiResource(Endpoints::STAGESHINE_CHANNEL_FOLLOWERS['endpoint'],Endpoints::STAGESHINE_CHANNEL_FOLLOWERS['class']);
});

Route::get('/eventbrite/me', 'Eventbrite\TestController@getMe');

//Route::post('route','Controller@method')->middleware('<middleware-name-here>');

