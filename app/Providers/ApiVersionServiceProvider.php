<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/7/2
 * Time: 上午10:49
 */

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ApiVersionServiceProvider extends EventServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
	}

	/**
	 * Boot the authentication services for the application.
	 *
	 * @return void
	 */
	public function boot()
	{
		app('events')->listen(
			'laravels.received_request',
			function (\Illuminate\Http\Request $request) {
				$ref = new \ReflectionObject($request);
				$pathInfo = $ref->getProperty('pathInfo');
				$pathInfo->setAccessible(true);
				$pathInfo->setValue($request, '/' . $this->getVersion($request) . '/' . $request->path());
			});
	}

	protected function getVersion(Request $request)
	{
		if (
			!$request->hasHeader('Api-Version') ||
			empty(trim($request->headers->get('Api-Version')))
		) {
			return 'v1';
		}

		$header = $request->headers->get('Api-Version');

		return $header;
	}
}
