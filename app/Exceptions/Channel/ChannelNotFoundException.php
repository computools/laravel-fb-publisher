<?php

namespace App\Exceptions\Channel;

use App\Exceptions\NotFoundApiException;

class ChannelNotFoundException extends NotFoundApiException
{
	protected $message = 'Channel not found';
}