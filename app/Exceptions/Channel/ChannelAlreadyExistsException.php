<?php

namespace App\Exceptions\Channel;

use App\Exceptions\ConflictApiException;

class ChannelAlreadyExistsException extends ConflictApiException
{
	protected $message = 'Channel already exists';
}