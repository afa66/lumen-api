<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/2
 * Time: 下午2:21
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		// 根据环境变量切换数据库连接
		if (app()->environment() === 'production') {
			$this->connection = 'production';
		}
	}
}