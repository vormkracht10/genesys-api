<?php

namespace Vormkracht10\GenesysApi;

class Genesys
{
    private $clientId;

    private $clientSecret;

    private $accessToken;

    private $refreshToken;

    private $redirectUrl;

    private $client;

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

    public function requestAccessToken($code)
    {
        //
    }
}
