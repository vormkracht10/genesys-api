<?php

namespace Vormkracht10\GenesysApi;

use GuzzleHttp\Client;

class Genesys
{
    private string $clientId;

    private string $clientSecret;

    private string $accessToken;

    private string $refreshToken;

    private string $redirectUrl;

    private string $region;

    private string $appUrl = 'https://api.mypurecloud.';

    private string $loginUrl = 'https://login.mypurecloud.';

    private string $apiUrl = 'https://api.mypurecloud.';

    public Client $client;

    public function __construct(string $region)
    {
        $this->region = $region;
        $this->client = new Client();

        $this->createUrlsForRegion($region);
    }

    public static function api(string $region): Genesys
    {
        return new Genesys($region);
    }

    private function createUrlsForRegion(string $region): void
    {
        match ($region) {
            'eu' => $this->setUrls($this->appUrl . 'eu', $this->loginUrl . 'eu', $this->apiUrl . 'eu'),
            'jp' => $this->setUrls($this->appUrl . 'jp', $this->loginUrl . 'jp', $this->apiUrl . 'jp'),
            'us' => $this->setUrls($this->appUrl . 'com', $this->loginUrl . 'com', $this->apiUrl . 'com'),
        };
    }

    private function setUrls(string $appUrl, string $loginUrl, string $apiUrl): void
    {
        $this->appUrl = $appUrl;
        $this->loginUrl = $loginUrl;
        $this->apiUrl = $apiUrl . '/api/v2';
    }

    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function setClientSecret(string $clientSecret): self
    {
        $this->clientSecret = $clientSecret;

        return $this;
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

    public function setRedirectUrl(string $redirectUrl): self
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
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

        return $this->loginUrl . '/oauth/authorize?' . $query;
    }

    public function requestAccessToken(string $code): string
    {
        $response = $this->client->asForm()
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
        $response = $this->client->asForm()
            ->withBasicAuth(
                $this->clientId(),
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
    public function requestApiToken(): array
    {
        $response = $this->client->post($this->loginUrl . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'scope' => '',
                ],
            ])
            ->getBody()
            ->getContents();

        $response = json_decode($response, true);

        $this->setAccessToken($response['access_token']);

        return $response;
    }
}
