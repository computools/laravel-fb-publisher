<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    private const DEFAULT_MESSAGE = 'Internal server error';

	protected $messageMap = [
		NotFoundHttpException::class => 'Not found',
		MethodNotAllowedHttpException::class => 'Method not allowed'
	];

	/**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception): Response
    {
        return $this->getJsonResponse($exception);
    }

    protected function getJsonResponse(Exception $exception): Response
	{
		if (!$exception instanceof ApiException) {
			if ($this->isHttpException($exception)) {
				return response(
					[
						'message' => !empty($exception->getMessage()) ? $exception->getMessage(
						) : ($this->messageMap[get_class($exception)] ?? self::DEFAULT_MESSAGE)
					],
					$exception->getStatusCode()
				);
			} else if ($exception instanceof ValidationException) {
				return response([
					'message' => 'Bad request',
					'errors' => $exception->validator->errors()->getMessages()
				], Response::HTTP_BAD_REQUEST);
			} else {
				return response([
					'message' => !empty($exception->getMessage()) ? $exception->getMessage() : ($this->messageMap[get_class($exception)] ?? self::DEFAULT_MESSAGE)
				], Response::HTTP_INTERNAL_SERVER_ERROR);
			}

		} else {
			return response([
				'message' => $exception->getMessage(),
			], $exception->getStatusCode());
		}
	}
}
