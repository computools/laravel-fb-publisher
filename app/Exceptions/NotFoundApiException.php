<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class NotFoundApiException extends ApiException
{
	protected $statusCode = Response::HTTP_NOT_FOUND;
	protected $message = 'Not found';
}