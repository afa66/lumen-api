<?php

namespace App\Http\Controllers\Apis\V1;

use App\Models\User;
use EasyWeChat\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends BaseController
{
	public function store(Request $request)
	{
		$this->toValidate($request, [
			'code'          => 'required',
			'encryptedData' => 'required',
			'iv'            => 'required',
		]);
		
		$config = config('wechat.mini_program');
		$app = Factory::miniProgram($config);

		$sessionKey = $app->auth->session($request->code);
		$userInfo = $app->encryptor->decryptData(
			$sessionKey['session_key'], $request->iv, $request->encryptedData
		);

		$user = User::updateOrCreate([
			'open_id'     => $userInfo['open_id'],
			'union_id'    => $userInfo['union_id'] ?? '',
			'session_key' => $sessionKey['session_key'],
		], [
			'nick_name'  => $userInfo['nickName'],
			'gender'     => $userInfo['gender'],
			'language'   => $userInfo['language'],
			'city'       => $userInfo['city'],
			'province'   => $userInfo['province'],
			'country'    => $userInfo['country'],
			'avatar_url' => $userInfo['avatarUrl'],
		]);
		if (!$token = Auth::login($user)) {
			return $this->response->errorUnauthorized('登录失败');
		}

		return $this->respondWithToken($token);
	}

	public function update()
	{
		$token = Auth::refresh();

		return $this->respondWithToken($token);
	}

	public function destory()
	{
		Auth::logout();

		return $this->response->noContent();
	}

	protected function respondWithToken($token)
	{
		return $this->response->array([
			'access_token' => $token,
			'token_type'   => 'Bearer',
			'expired_at'   => time() + \Auth::factory()->getTTl() * 60,
		]);
	}

}
