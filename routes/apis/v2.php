<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/2
 * Time: 上午9:39
 */

$router->group([
	'prefix' => 'v2',
	'namespace' => 'Apis\V1'
], function () use($router) {
	$router->get('test', 'TestController@index2');
});
