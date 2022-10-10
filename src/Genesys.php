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

    public string $region;

    private string $appUrl = 'https://api.mypurecloud.';

    private string $loginUrl = 'https://login.mypurecloud.';

    private string $apiUrl = 'https://api.mypurecloud.';

    private Client $client;

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
        switch ($region) {
            case 'eu':
                $this->setUrls($this->appUrl . 'eu', $this->loginUrl . 'eu', $this->apiUrl . 'eu');

                break;

            case 'jp':
                $this->setUrls($this->appUrl . 'jp', $this->loginUrl . 'jp', $this->apiUrl . 'jp');

                break;

            case 'us':
            default:
                $this->setUrls($this->appUrl . 'com', $this->loginUrl . 'com', $this->apiUrl . 'com');

                break;
        }
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

    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setRefreshToken(string $refreshToken): self
    {
        $this->refreshToken = $refreshToken;

        return $this;
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

    public function setLoginUrl(string $loginUrl): self
    {
        $this->loginUrl = $loginUrl;

        return $this;
    }

    public function getLoginUrl(): string
    {
        return $this->loginUrl;
    }

    public function getAuthorizationUrl(): string
    {
        $query = http_build_query([
            'client_id' => $this->getClientId(),
            'redirect_uri' => $this->getRedirectUrl(),
            'response_type' => 'code',
            'scope' => '',
        ]);

        return $this->getLoginUrl() . '/oauth/authorize?' . $query;
    }

    public function requestAccessToken(string $code): array
    {
        $response = $this->client->post($this->getLoginUrl() . '/oauth/token', [
            'auth' => [
                $this->getClientId(),
                $this->getClientSecret(),
            ],
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->getRedirectUrl(),
        ])
        ->getBody()
        ->getContents();

        $response = json_decode($response, true);

        $this->setAccessToken($response['access_token']);
        $this->setRefreshToken($response['refresh_token']);

        return $response;
    }

    public function requestAccessTokenWithRefreshToken(string $refreshToken): array
    {
        $response = $this->client->post($this->getLoginUrl() . '/oauth/token', [
            'auth' => [
                $this->getClientId(),
                $this->getClientSecret(),
            ],
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
            ],
        ])
        ->getBody()
        ->getContents();

        $response = json_decode($response, true);

        $this->setAccessToken($response['access_token']);

        return $response;
    }

    public function requestApiToken(): array
    {
        $response = $this->client->post($this->getLoginUrl() . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->getClientId(),
                'client_secret' => $this->getClientSecret(),
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
