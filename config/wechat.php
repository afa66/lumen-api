<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/2
 * Time: 上午10:37
 */

return [
	'mini_program' => [
		'app_id'        => '',
		'secret'        => '',

		// 下面为可选项
		// 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
		'response_type' => 'array',

		'log' => [
			'level' => 'debug',
			'file'  => __DIR__ . '/wechat.log',
		],
	],
];