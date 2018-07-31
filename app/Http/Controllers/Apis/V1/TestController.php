<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/3
 * Time: 下午3:39
 */

namespace App\Http\Controllers\Apis\V1;

use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends BaseController
{
	public function index()
	{
		throw new ApiException('124');
		return $this->success('v1');
	}

	public function index2()
	{
		return $this->success('v2');
	}

	public function index3()
	{
		return $this->success('v3');
	}
}