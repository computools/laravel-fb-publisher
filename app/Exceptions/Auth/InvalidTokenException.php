<?php

namespace App\Exceptions\Auth;

use App\Exceptions\UnauthorizedApiException;

class InvalidTokenException extends UnauthorizedApiException
{
	protected $message = 'Invalid or expired token';
}