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

		$app = $this->miniProgramApp();

		$sessionKey = $app->auth->session($request->code);
		try {
			$userInfo = $app->encryptor->decryptData(
				$sessionKey['session_key'], $request->iv, $request->encryptedData
			);
		} catch (\Exception $e) {
			abort(500, '解密session_key失败');
		}

		$user = User::where('open_id', $userInfo['open_id'])->first();

		if (!$user) {
			$user              = new User();
			$user->open_id     = $userInfo['openId'];
			$user->union_id    = $userInfo['unionId'] ?? null;
			$user->session_key = $sessionKey['session_key'];
			$user->nick_name   = $userInfo['nickName'];
			$user->gender      = $userInfo['gender'];
			$user->language    = $userInfo['language'];
			$user->city        = $userInfo['city'];
			$user->province    = $userInfo['province'];
			$user->country     = $userInfo['country'];
			$user->avatar_url  = $userInfo['avatar_url'];
		} else {
			// 如初期没有绑定开放平台,后期需补绑union_id
//			if ($user->union_id === null) {
//				$user->union_id = $userInfo['union_id'];
//			}
		}

		$user->save();

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
		return $this->success([
			'access_token' => $token,
			'token_type'   => 'Bearer',
			'expired_at'   => time() + \Auth::factory()->getTTl() * 60,
		], 201);
	}

}
