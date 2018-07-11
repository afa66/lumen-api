<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/2
 * Time: 上午9:39
 */
var_dump(1111);
$api = app(Dingo\Api\Routing\Router::class);
$api->version('v1', [
	'namespace'  => 'App\Http\Controllers\Apis\V1',
	'middleware' => 'cors'
], function ($api) {
	$api->get('test', 'TestController@index');
	$api->post('authorizations', 'AuthController@store');

	$api->group([
		'middleware' => ['api.throttle', 'api.auth'],
		'limit'      => 1, // expires设置的时间内,能请求的次数
		'expires'    => 1, // 分钟
	], function ($api) {
		$api->put('authorizations', 'AuthController@update');
		$api->delete('authorizations', 'AuthController@destory');
	});

});
