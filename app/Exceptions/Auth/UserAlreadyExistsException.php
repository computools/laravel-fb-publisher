<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ConflictApiException;

class UserAlreadyExistsException extends ConflictApiException
{
	protected $message = 'User already registered';
}