<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['api']], function () {
	Route::get('', 'DefaultController@index');
	Route::post('auth/register', 'AuthController@register');
	Route::post('auth/login', 'AuthController@login');
	Route::group(['middleware' => 'jwt.auth'], function() {

		/**
		 * User section
		 */
		Route::get('user', 'UserController@getInfo');

		/**
		 * Post section
		 */
		Route::get('post', 'PostController@getList');
		Route::get('post/{id}', 'PostController@getPost');
		Route::post('post', 'PostController@create');
		Route::put('post/{id}', 'PostController@update');
		Route::put('post/{postId}/theme/{themeId}', 'PostController@addTheme');
		Route::delete('post/{postId}/theme/{themeId}', 'PostController@removeTheme');
		Route::delete('post/{id}', 'PostController@delete');

		/**
		 * Theme section
		 */
		Route::get('theme', 'ThemeController@getList');
		Route::post('theme', 'ThemeController@create');
		Route::put('theme/{id}', 'ThemeController@update');
		Route::delete('theme/{id}', 'ThemeController@delete');

		/**
		 * Channel section
		 */
		Route::get('channel', 'ChannelController@listChannels');
		Route::get('channel/link', 'ChannelController@getAuthLink');
		Route::post('channel', 'ChannelController@addChannel');
		Route::delete('channel/{channelId}', 'ChannelController@delete');

		/**
		 * Publication section
		 */
		Route::post('post/{postId}/publication/{channelId}', 'PublicationController@create');
	});
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
