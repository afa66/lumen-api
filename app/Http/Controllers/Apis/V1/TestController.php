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
use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{
	public function index()
	{
		return Cache::remember('test', 1, function (){
			return 'this is test controller';
		});
	}
}