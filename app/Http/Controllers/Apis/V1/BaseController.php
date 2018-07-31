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
use Illuminate\Validation\ValidationException;

class BaseController extends Controller
{
	public function __construct(Request $request)
	{
	}

	protected function toValidate($request, $rules, $messages = [])
	{
		$validator = \Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			throw new ValidationException($validator);
		}
	}

	protected function success($data = [], $statusCode = 200)
	{
		$response['status_code'] = $statusCode;
		$response['message'] = 'success';
		if (!empty($data)) {
			$response['data'] = $data;
		}

		return response()->json($response)->setStatusCode($statusCode);
	}

	protected function fail($messsage, $statusCode = 422)
	{
		return response()->json([
			'status_code' => $statusCode,
			'message' => $messsage
		])->setStatusCode($statusCode);
	}
}