<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/2
 * Time: 上午9:39
 */
$api = app(Dingo\Api\Routing\Router::class);
$api->version('v1', [
	'namespace'  => 'App\Http\Controllers\Apis\V1',
], function ($api) {
	$api->post('authorizations/login', 'AuthController@store');
	$api->group([
		'middleware' => ['api.throttle', 'api.auth'],
		'limit'      => 1, // expires设置的时间内,能请求的次数
		'expires'    => 1, // 分钟
	], function ($api) {
		$api->post('authorizations/refreshToken', 'AuthController@update');
		$api->post('authorizations/logout', 'AuthController@destory');
	});

});
