<?php

namespace App\Providers;

use App\Services\Facebook\FacebookSessionCustomPersistentDataHandler;
use Facebook\Facebook;
use Illuminate\Support\ServiceProvider;

class FacebookServiceProvider extends ServiceProvider
{
	public function boot()
	{

	}

	public function register()
	{
		$config = config('facebook.config');
		$config['persistent_data_handler'] = new FacebookSessionCustomPersistentDataHandler();
		$this->app->singleton(Facebook::class, function ($app) use ($config) {
			return new Facebook($config);
		});
	}
}