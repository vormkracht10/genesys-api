<?php

namespace Vormkracht10\GenesysApi\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Vormkracht10\GenesysApi\Genesys;

class GenesysProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/genesys.php' => config_path('genesys.php'),
        ]);
    }

    public function register(): void
    {
        $this->app->singleton(Genesys::class, function ($app, array $params) {
            $config = $app->make('config')->get('genesys');

            return new Genesys(
                region: $config['region'],
            );
        });
    }

    /** @return array<int, string> */
    public function provides(): array
    {
        return [Genesys::class];
    }
}
