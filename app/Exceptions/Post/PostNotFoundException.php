<?php

namespace App\Exceptions\Post;

use App\Exceptions\NotFoundApiException;

class PostNotFoundException extends NotFoundApiException
{
	protected $message = 'Post not found';
}