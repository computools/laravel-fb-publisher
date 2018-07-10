<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class UnauthorizedApiException extends ApiException
{
	protected $statusCode = Response::HTTP_UNAUTHORIZED;
	protected $message = 'Unauthorized';
}