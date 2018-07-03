<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/3
 * Time: 下午3:39
 */
namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Models\User;

class TestController extends Controller
{
	public function index()
	{
		return 'this is test controller';
	}
}