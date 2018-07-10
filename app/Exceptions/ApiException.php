<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiException extends HttpException
{
	protected $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
	protected $message = 'Internal server error';

	public function __construct(?string $message = null)
	{
		parent::__construct($this->statusCode, $message ? $message : $this->message);
	}
}