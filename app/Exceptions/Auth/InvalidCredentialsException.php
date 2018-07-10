<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ConflictApiException;

class InvalidCredentialsException extends ConflictApiException
{
	protected $message = 'Invalid credentials';
}