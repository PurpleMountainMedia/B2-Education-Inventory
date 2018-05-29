<?php

namespace B2Systems\B2SoftwareBase;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Illuminate\Filesystem\Filesystem;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    const VERSION = '0.0.1';

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'local') {
            $this->handleMigrations();
        }
    }

    /**
     * Pull in the migration files.
     *
     * @return void
     */
    private function handleMigrations()
    {
        $files = new FileSystem();
        foreach ($files->glob('database/migrations/*_*.php') as $key => $file) {
            $files->requireOnce($file);
        }

        if (! class_exists('CreateUsersTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_users_table.php.stub' =>
                database_path('migrations/'.date('Y_m_d_His', time()).'_create_users_table.php'),
            ], 'b2-migrations');
        }
    }
}
