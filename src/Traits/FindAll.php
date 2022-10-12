<?php

namespace Vormkracht10\GenesysApi\Traits;

trait FindAll
{
    public function get(
        array $params = [],
    ): string {

        $endpoint = $this->getEndpoint('get');

        if (count($params) > 0) {
            foreach ($params as $key => $value) {
                $endpoint = str_replace('{' . $key . '}', $value, $endpoint);
            }
        }

        return $this->connection()->get(
            $endpoint
        );
    }
}