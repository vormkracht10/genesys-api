<?php

namespace Vormkracht10\GenesysApi\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Vormkracht10\GenesysApi\Genesys as GenesysApi;

class Genesys extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GenesysApi::class, function ($app, $accessToken) {

            $config = $app->make('config')->get('genesys');

            return new GenesysApi(
                region: $config['region'],
                accessToken: $accessToken,
            );
        });
    }

    /** @return array<int, string> */
    public function provides(): array
    {
        return [GenesysApi::class];
    }
}
