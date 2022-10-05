<?php

namespace Vormkracht10\GenesysApi;

use Illuminate\Support\Facades\Http;

class Genesys
{
    private $clientId;

    private $clientSecret;

    private $accessToken;

    private $refreshToken;

    private $redirectUrl;

    private $loginUrl;

    private $region;

    public function __construct()
    {
        //
    }

    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function setClientSecret(string $clientSecret): void
    {
        $this->clientSecret = $clientSecret;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setRefreshToken(string $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function setRedirectUrl(string $redirectUrl): void
    {
        $this->redirectUrl = $redirectUrl;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

    public function setLoginUrl(string $loginUrl): void
    {
        $this->loginUrl = $loginUrl;
    }

    public function getLoginUrl(): string
    {
        return $this->loginUrl;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    /** @todo based on the region the correct auth url should be returned. */
    public function getAuthorizationUrl(): string
    {
        $query = http_build_query([
            'client_id' => $this->getClientId(),
            'redirect_uri' => $this->getRedirectUrl(),
            'response_type' => 'code',
            'scope' => '',
        ]);

        return 'https://login.mypurecloud.com' . '/oauth/authorize?' . $query;
    }

    public function requestAccessToken(string $code): string
    {
        $response = Http::asForm()
            ->withBasicAuth(
                $this->getClientId(),
                $this->getClientSecret()
            )->post($this->getLoginUrl() . '/oauth/token', [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $this->getRedirectUrl(),
            ])
            ->throw()
            ->json();

        $this->setAccessToken($response['access_token']);

        return $this->getAccessToken();
    }

    public function requestAccesTokenWithRefreshToken(string $refreshToken): string
    {
        $response = Http::asForm()
            ->withBasicAuth(
                $this->getClientId(),
                $this->getClientSecret()
            )->post($this->getLoginUrl() . '/oauth/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
            ])
            ->throw()
            ->json();

        $this->setAccessToken($response['access_token']);

        return $this->getAccessToken();
    }

    /** @todo not sure if we need this, need confirmation. */
    public function requestApiToken()
    {
        $response = Http::asForm()
            ->post($this->getLoginUrl() . '/oauth/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $this->getClientId(),
                'client_secret' => $this->getClientSecret(),
                'scope' => '',
            ])
            ->throw()
            ->json();

        $this->setAccessToken($response['access_token']);
    }
}
