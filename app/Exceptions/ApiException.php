<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/30
 * Time: 上午11:06
 */

namespace App\Exceptions;

class ApiException extends \Exception
{
	protected $statusCode;
	protected $message;

	public function __construct($messasge, $statusCode = 422)
	{
		$this->message = $messasge;
		$this->statusCode = $statusCode;
	}

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function getError()
	{
		return $this->message;
	}
}