<?php

namespace Vormkracht10\GenesysApi\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Vormkracht10\GenesysApi\Genesys;

class GenesysProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Genesys::class, function ($app, $accessToken) {
            $config = $app->make('config')->get('genesys');

            return new Genesys(
                region: $config['region'],
                accessToken: $accessToken,
            );
        });
    }

    /** @return array<int, string> */
    public function provides(): array
    {
        return [Genesys::class];
    }
}
