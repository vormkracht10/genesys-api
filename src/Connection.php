<?php

namespace Vormkracht10\GenesysApi;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Connection
{
    private string $accessToken;

    private Client $client;

    public string $apiDomain = 'https://api.mypurecloud.com/api/v2';

    public string $authDomain = 'https://login.mypurecloud.com';

    public function __construct(string|null $region)
    {
        $this->setRegion($region);
        $this->client();
    }

    private function client(): Client
    {
        $this->client = new Client(
            [
                'http_errors' => true,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]
        );

        return $this->client;
    }

    private function request(string $method, string $url, array $options = [])
    {
        $options['headers'] = array_merge(
            $options['headers'] ?? [],
            [
                'Authorization' => 'Bearer ' . $this->accessToken,
            ]
        );

        return $this->client->request(
            method: $method,
            uri: $url,
            options: $options
        );
    }

    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function get(string $url, array $params = []): array|Exception
    {
        try {
            $query = http_build_query($params);

            $request = $this->request('GET', $this->formatUrl($url) . '?' . $query);

            return $this->parseResponse($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new Exception($this->parseExceptionMessage($e), $e->getCode());
        }
    }

    public function post(string $url, array $params = []): array|Exception
    {
        try {

            $request = $this->request('POST', $this->formatUrl($url), $params);


            return $this->parseResponse($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new Exception($this->parseExceptionMessage($e), $e->getCode());
        }
    }

    public function patch(string $url, array $params = []): array|Exception
    {
        try {
            $request = $this->client->patch($this->formatUrl($url), $params);

            return $this->parseResponse($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new Exception($this->parseExceptionMessage($e), $e->getCode());
        }
    }

    public function put(string $url, array $params = []): array|Exception
    {
        try {
            $request = $this->client->put($this->formatUrl($url), $params);

            return $this->parseResponse($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new Exception($this->parseExceptionMessage($e), $e->getCode());
        }
    }

    public function delete(string $url): array|Exception
    {
        try {
            $request = $this->client->delete($this->formatUrl($url));

            return $this->parseResponse($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new Exception($this->parseExceptionMessage($e), $e->getCode());
        }
    }

    private function parseResponse(object $response): array
    {
        $response = $response->getBody()->getContents();

        if (empty($response)) {
            return [];
        }

        return json_decode($response, true);
    }

    private function parseExceptionMessage(\GuzzleHttp\Exception\ClientException $e): string
    {
        $response = $e->getResponse();
        $responseBodyAsString = $response->getBody()->getContents();

        $responseBody = json_decode($responseBodyAsString);

        $message = $responseBody->message ?? $responseBodyAsString;

        return $message;
    }

    private function formatUrl(string $url): string
    {
        return $this->apiDomain . '/' . $url;
    }

    /**
     * Set the correct API and Auth domains based on the region
     * @see https://developer.genesys.cloud/platform/api/
     */
    private function setRegion(string|null $region): void
    {
        switch ($region) {
            case 'us-east-2':
                $this->apiDomain = 'https://api.use2.us-gov-pure.cloud/api/v2';
                $this->authDomain = 'https://login.use2.us-gov-pure.cloud';

                break;
            case 'us-west-2':
                $this->apiDomain = 'https://api.usw2.pure.cloud/api/v2';
                $this->authDomain = 'https://login.usw2.pure.cloud';

                break;
            case 'ca-central-1':
                $this->apiDomain = 'https://api.cac1.pure.cloud/api/v2';
                $this->authDomain = 'https://login.cac1.pure.cloud';

                break;
            case 'sa-east-1':
                $this->apiDomain = 'https://api.sae1.pure.cloud/api/v2';
                $this->authDomain = 'https://login.sae1.pure.cloud';

                break;
            case 'eu-central-1':
                $this->apiDomain = 'https://api.mypurecloud.de/api/v2';
                $this->authDomain = 'https://login.mypurecloud.de';

                break;
            case 'eu-west-1':
                $this->apiDomain = 'https://api.mypurecloud.ie/api/v2';
                $this->authDomain = 'https://login.mypurecloud.ie';

                break;
            case 'eu-west-2':
                $this->apiDomain = 'https://api.euw2.pure.cloud/api/v2';
                $this->authDomain = 'https://login.euw2.pure.cloud';

                break;
            case 'ap-south-1':
                $this->apiDomain = 'https://api.aps1.pure.cloud/api/v2';
                $this->authDomain = 'https://login.aps1.pure.cloud';

                break;
            case 'ap-northeast-2':
                $this->apiDomain = 'https://api.apne2.pure.cloud/api/v2';
                $this->authDomain = 'https://login.apne2.pure.cloud';

                break;
            case 'ap-southeast-2':
                $this->apiDomain = 'https://api.mypurecloud.com.au/api/v2';
                $this->authDomain = 'https://login.mypurecloud.com.au';

                break;
            case 'ap-northeast-1':
                $this->apiDomain = 'https://api.mypurecloud.jp/api/v2';
                $this->authDomain = 'https://login.mypurecloud.jp';

                break;
            default:
            case 'us-east-1':
                $this->apiDomain = 'https://api.mypurecloud.com/api/v2';
                $this->authDomain = 'https://login.mypurecloud.com';

                break;
        }
    }
}
