<?php

namespace App\Services\Facebook;

use Facebook\PersistentData\PersistentDataInterface;

class FacebookSessionCustomPersistentDataHandler implements PersistentDataInterface
{
	protected $sessionPrefix = 'FBRLH_';

	public function __construct()
	{
		session()->start();
	}

	public function get($key)
	{
		return session()->get($this->sessionPrefix . $key);
	}

	public function set($key, $value)
	{
		session()->put($this->sessionPrefix . $key, $value);
		session()->save();
	}
}