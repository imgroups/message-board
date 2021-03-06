<?php

namespace MicheleAngioni\MessageBoard\Providers;

use Illuminate\Support\ServiceProvider;

class MessageBoardAPIServiceProvider extends ServiceProvider
{
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
        // Load API routes
        require __DIR__.'/../Http/routes.php';
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerRepositories();

        // Register the GrahamCampbell Throttle Service Provider
        $this->app->register('GrahamCampbell\Throttle\ThrottleServiceProvider');
    }

    protected function registerRepositories()
    {
        $this->app->bind(
            'MicheleAngioni\MessageBoard\Contracts\UserRepositoryInterface',
            'MicheleAngioni\MessageBoard\Repos\EloquentUserRepository'
        );
    }
}
