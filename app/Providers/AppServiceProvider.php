<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

	public function boot()
	{
//		$this->app->singleton(\Illuminate\Auth\AuthManager::class, function ($app) {
//			return $app->make('auth');
//		});
		$this->app->configureMonologUsing(function(\Monolog\Logger $monoLog) {
			return $monoLog->pushHandler(
				new \Monolog\Handler\RotatingFileHandler($this->app->storagePath().'/logs/log.log',5)
			);
		});
    }
}
