<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/2
 * Time: 上午10:49
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DingoServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// 注册Dingo服务
		$this->app->register(\Dingo\Api\Provider\LumenServiceProvider::class);
	}

	/**
	 * Boot the authentication services for the application.
	 *
	 * @return void
	 */
	public function boot()
	{
		// 使用jwt认证
		app('Dingo\Api\Auth\Auth')->extend('jwt', function ($app) {
			return new \Dingo\Api\Auth\Provider\JWT($app['Tymon\JWTAuth\JWTAuth']);
		});
		// 开启访问节流
		$this->app['Dingo\Api\Http\RateLimit\Handler']->extend(function () {
			return new \Dingo\Api\Http\RateLimit\Throttle\Authenticated;
		});
		// 自定义ModelNotFoundException异常响应
		app('Dingo\Api\Exception\Handler')->register(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			return response()->json([
				'status_code' => 404,
				'message' => '未找到对应的数据',
			], JSON_UNESCAPED_UNICODE);
		});
	}
}
