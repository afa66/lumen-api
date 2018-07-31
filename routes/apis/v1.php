<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/2
 * Time: 上午9:39
 */

$router->group([
	'namespace' => 'Apis\V1',
	'prefix' => 'v1',
], function () use($router) {
	$router->get('login-test', 'TestController@test');
	$router->get('test', 'TestController@index');
	// jwt
	$router->post('authorizations', 'AuthController@store');
	$router->put('authorizations', 'AuthController@update');
	$router->delete('authorizations', 'AuthController@destory');
	$router->group([
		'middleware' => 'auth'
	], function () use ($router) {
		$router->get('test3', 'TestController@index3');
	});
});
