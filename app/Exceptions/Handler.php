<?php

namespace App\Exceptions;

use App\Http\Middleware\ThrottleRequests;
use Exception;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		AuthorizationException::class,
		HttpException::class,
		ModelNotFoundException::class,
		ValidationException::class,
		ApiException::class,
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		if ($e instanceof ValidationException) {
			$statusCode = 422;
			$message = $e->errors();
		} elseif ($e instanceof NotFoundHttpException) {
			$statusCode = 404;
			$message = '请求地址不正确';
		} elseif ($e instanceof ModelNotFoundException) {
			$statusCode = 404;
			$message = '未找到对应记录';
		} elseif ($e instanceof ApiException) {
			$statusCode = $e->getStatusCode();
			$message = $e->getError();
		} elseif ($e instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
			$statusCode = 401;
			$message = $e->getMessage();
		} elseif ($e instanceof ThrottleRequests) {
			$statusCode = $e->getStatusCode();
			$message = $e->getMessage();
		} else {
			$statusCode = $e->getCode() != 0 ?: 500;
			$message = $e->getMessage();
		}
//		switch (get_class($e)) {
//			case ModelNotFoundException::class :
//				$statusCode = 404;
//				$message = '未找到对应记录';
//				break;
//			case ValidationException::class :
//				$statusCode = 422;
//				$message = $e->errors();
//				break;
//			case NotFoundHttpException::class :
//				$statusCode = 404;
//				$message = '请求地址不正确';
//				break;
//			case ApiException::class :
//				$statusCode = $e->getStatusCode();
//				$message = $e->getError();
//				break;
//			default:
//				$statusCode = $e->getCode() !== 0 ?: 500;
//				$message = $e->getTrace();
//		}

		return response()->json([
			'status_code' => $statusCode,
			'message'     => $message,
		])->setStatusCode($statusCode);

//		return parent::render($request, $e);
	}
}
