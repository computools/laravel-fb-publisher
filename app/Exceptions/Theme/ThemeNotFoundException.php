<?php

namespace App\Exceptions\Theme;

use App\Exceptions\NotFoundApiException;

class ThemeNotFoundException extends NotFoundApiException
{
	protected $message = 'Theme not found';
}