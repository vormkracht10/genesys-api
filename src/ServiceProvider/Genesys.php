<?php

namespace Vormkracht10\GenesysApi\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Vormkracht10\GenesysApi\Genesys as GenesysApi;

class Genesys extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GenesysApi::class, function ($app) {
            $config = $app->make('config')->get('genesys');

            return new GenesysApi(
                region: $config['region'],
                accessToken: $config['access_token'],
                // Get access token by user
            );
        });

        // $this->app->when(GenesysApi::class)
        //     ->needs('$accessToken')
        //     ->give($accessToken);
    }

    /** @return array<int, string> */
    public function provides(): array
    {
        return [GenesysApi::class];
    }
}
