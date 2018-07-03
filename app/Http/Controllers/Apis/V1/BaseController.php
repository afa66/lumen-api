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

	public function __construct(Request $request)
	{
		$this->toValidate($request, [
			'xid' => 'required'
		]);
	}


	protected function toValidate($request, $rules, $messages = [])
	{
		$validator = \Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			throw new ValidationHttpException($validator->errors()->toArray());
		}
	}
}