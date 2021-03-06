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
	'middleware' => 'cors'
], function ($api) {
	$api->get('test', 'TestController@index');
	$api->post('authorizations', 'AuthController@store');
	$api->put('authorizations', 'AuthController@update');

	$api->group([
		'middleware' => ['api.throttle', 'api.auth'],
		'limit'      => 10, // expires设置的时间内,能请求的次数
		'expires'    => 1, // 分钟
	], function ($api) {
		$api->delete('authorizations', 'AuthController@destory');
	});
});
