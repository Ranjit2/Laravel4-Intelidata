<?php namespace Ahir\Velocity;

use Illuminate\Support\ServiceProvider;

class VelocityServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('ahir/velocity');
        include __DIR__.'/../../routes.php';        
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['ahir.velocity'] = $this->app->share(function($app)
        {
        	return new Velocity();
        });	
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
