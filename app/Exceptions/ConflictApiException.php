<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ConflictApiException extends ApiException
{
	protected $statusCode = Response::HTTP_CONFLICT;
	protected $message = 'Conflict';
}