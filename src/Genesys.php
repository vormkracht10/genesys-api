<?php

namespace Vormkracht10\GenesysApi;

use GuzzleHttp\Client;

class Genesys
{
    public string $accessToken;

    public string $region;

    public string $apiDomain = 'https://api.mypurecloud.com/api/v2';

    public string $authDomain = 'https://login.mypurecloud.com';

    public Client $client;

    public function __construct(string $accessToken, string $region)
    {
        $this->accessToken = $accessToken;
        $this->region = $region;
    
        $this->client = new Client();

        $this->setRegion($region);
    }

    public static function api(string $accessToken, string|null $region = null): Genesys
    {
        return new Genesys(accessToken: $accessToken, region: $region);
    }

  /**
     * Set the correct API and Auth domains based on the region
     * @see https://developer.genesys.cloud/platform/api/
     *
     * @param string $region
     * @return void
     */
    private function setRegion(string $region): void
    {
        switch ($region) {
            case 'us-east-1':
                $this->apiDomain = 'https://api.mypurecloud.com/api/v2';
                $this->authDomain = 'https://login.mypurecloud.com';

                break;
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
        }
    }
}
