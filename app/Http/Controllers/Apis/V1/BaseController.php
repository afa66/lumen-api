<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/2
 * Time: 上午9:47
 */

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class BaseController extends Controller
{
	use Helpers;

	protected function toValidate($request, $rules, $messages = [])
	{
		$validator = \Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			throw new ValidationHttpException($validator->errors()->toArray());
		}
	}

	protected function success(array $data = [], int $statusCode = 200)
	{
		$response['status_code'] = $statusCode;
		$response['message'] = 'ok';
		if (!empty($data)) {
			$response['data'] = $data;
		}

		return $this->response->array($response);
	}
}