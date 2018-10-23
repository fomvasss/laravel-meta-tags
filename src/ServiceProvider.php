<?php

namespace Fomvasss\LaravelMetaTags;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishedConfig();

        $this->publishedMigrations();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'meta-tags');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/meta-tags'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/meta-tags.php', 'meta-tags');

        $this->app->singleton(Builder::class);
    }

    protected function publishedConfig()
    {
        $this->publishes([__DIR__ . '/../config/meta-tags.php' => config_path('meta-tags.php')
        ], 'meta-tags-config');
    }

    protected function publishedMigrations()
    {
        if (! class_exists('CreateMetaTagsTable')) {
            $timestamp = date('Y_m_d_His', time());

            $migrationPath = __DIR__.'/../database/migrations/create_meta_tags_table.php';
            $this->publishes([$migrationPath => database_path('/migrations/' . $timestamp . '_create_meta_tags_table.php'),
                ], 'meta-tags-migrations');
        }
    }
}
