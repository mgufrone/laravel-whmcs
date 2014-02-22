<?php namespace Beon\Whmcs;

use Illuminate\Support\ServiceProvider;
use Beon\Whmcs\Whmcs;
class WhmcsServiceProvider extends ServiceProvider {

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
		$this->package('beon/whmcs','whmcs-api');
		$this->setConnection();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
		$this->app['whmcs'] = $this->app->share(function($app){
			return new Whmcs;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('whmcs');
	}
	public function setConnection()
	{
	    $connection = \Config::get('whmcs-api::db');

	    \Config::set('database.connections.whmcs-api', $connection);
	}
}