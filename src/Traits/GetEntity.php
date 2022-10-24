<?php 

namespace Vormkracht10\GenesysApi\Traits;

trait GetEntity {

    public function get(string $id = '', array $params = []): array
    {
        $url = $this->replaceParameters(
            endpoint: $this->endpoints['GET'],
            params: ['id' => $id]
        );
        
        return $this->connection()->get($url, $params);
    }
}