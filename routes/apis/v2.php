<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/2
 * Time: 上午9:39
 */
var_dump(1111);
$api = app(Dingo\Api\Routing\Router::class);
$api->version('v2', [
	'namespace'  => 'App\Http\Controllers\Apis\V1',
	'middleware' => 'cors'
], function ($api) {
	$api->get('test', 'TestController@index2');

});
