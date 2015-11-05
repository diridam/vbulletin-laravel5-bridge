<?php

namespace diridam\Laravel5VbBridge;

use Illuminate\Support\ServiceProvider;

class VBulletinServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// Bind the user datamanager
		$this->app->bind('vbuserdm', function() {
			$forum_path = $this->app->basePath() . $this->app('config')->get('vbulletin.path');
			define('THIS_SCRIPT', 'laravel_user_datamanager');
			define('CWD', $forum_path);
			require_once "$forum_path/global.php";
			// Load up our essential files
			require_once "$forum_path/includes/functions.php";
			require_once "$forum_path/includes/class_core.php";
			require_once "$forum_path/includes/init.php"; // $vbulletin is defined in here
			$vbulletin = $GLOBALS['vbulletin'];
			$dataman =& datamanager_init('User', $vbulletin); // Grab the datamanager for User model
			return new Services\VBulletinUserDataManager($vbulletin, $dataman);
		});
		// Publish the configuration file
		$this->publishes([
			__DIR__.'/config/vbulletin.php' => config_path('vbulletin.php')
		]);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		//
	}
}
