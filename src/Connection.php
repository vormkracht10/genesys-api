<?php

namespace Vormkracht10\GenesysApi;

use GuzzleHttp\Client;
use GuzzleHttp\Client as GuzzleHttpClient;

class Connection
{
    private string $accessToken;

    private GuzzleHttpClient $client;

    public string $apiDomain = 'https://api.mypurecloud.com/api/v2';

    public string $authDomain = 'https://login.mypurecloud.com';

    public function __construct(string $accessToken, string|null $region)
    {
        $this->accessToken = $accessToken;
        $this->setRegion($region);
        $this->client();
    }

    private function client(): Client
    {
        $this->client = new Client(
            [
                'http_errors' => true,
                'expect' => false,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
            ]
        );

        return $this->client;
    }

    public function get(string $url, array $params = [], bool $fetchAll = false): string
    {
        $request = $this->client->get($this->formatUrl($url));

        return $request->getBody()->getContents();
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

                // no break
            default:
            case 'us-east-1':
                $this->apiDomain = 'https://api.mypurecloud.com/api/v2';
                $this->authDomain = 'https://login.mypurecloud.com';

                break;
        }
    }
}