<?php namespace diridam\Laravel5VbBridge;


use Illuminate\Support\ServiceProvider;

class VBulletinServiceProvider extends ServiceProvider {
	/**
	 * Indicates if loading of the provider is deferred.
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application services.
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register the application services.
	 * @return void
	 */
	public function register() {

		// Bind the user datamanager
		$this->app->bind( 'vbuserdm', function ( $app ) {
			$forum_path = $app['config']->get( 'vbulletin.path' );
			define( 'THIS_SCRIPT', 'laravel_user_datamanager' );
			$dir = getcwd();
			chdir( $forum_path );
			require './global.php';
			chdir( $dir );

			$vbulletin = $GLOBALS['vbulletin'];

			$dataman =& datamanager_init( 'User', $vbulletin ); // Grab the datamanager for User model
			return new Services\VBulletinUserDataManager( $vbulletin, $dataman );
		} );

		$this->app->bind('vbdm', function ($app){
			$forum_path = $app['config']->get( 'vbulletin.path' );
			define( 'THIS_SCRIPT', 'laravel_user_datamanager' );
			$dir = getcwd();
			chdir( $forum_path );
			require './global.php';
			chdir( $dir );

			$vbulletin = $GLOBALS['vbulletin'];
			return new Services\VBulletinDataManager($vbulletin);
		});
		// Publish the configuration file
		$this->publishes( [
		    __DIR__ . '/config/vbulletin.php' => config_path( 'vbulletin.php' )
		] );
	}

	/**
	 * Get the services provided by the provider.
	 * @return array
	 */
	public function provides() {
		//
	}
}
