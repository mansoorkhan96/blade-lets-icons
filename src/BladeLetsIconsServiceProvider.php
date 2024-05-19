<?php

declare(strict_types=1);

namespace Mansoor\LetsIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeLetsIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-lets-icons', []);

            $factory->add('lets-icons', array_merge(['path' => __DIR__.'/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-lets-icons.php', 'blade-lets-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-lets-icons'),
            ], 'blade-lets-icons');

            $this->publishes([
                __DIR__.'/../config/blade-lets-icons.php' => $this->app->configPath('blade-lets-icons.php'),
            ], 'blade-lets-icons-config');
        }
    }
}
