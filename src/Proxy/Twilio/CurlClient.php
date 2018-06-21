<?php

namespace Nixilla\Api\LoggerBundle\Proxy\Twilio;

use Nixilla\Api\LoggerBundle\Traits\Log;
use Twilio\Http\CurlClient as BaseClient;
use Twilio\Http\Response;

class CurlClient extends BaseClient
{
    use Log;

    public function request(
        $method,
        $url,
        $params = [],
        $data = [],
        $headers = [],
        $user = null,
        $password = null,
        $timeout = null
    )
    {
        $start = microtime(true);

        /** @var Response $result */
        $result = parent::request($method, $url, $params, $data, $headers, $user, $password, $timeout);

        if($this->hasLogger())
        {
            $time = microtime(true) - $start;

            $this->getLogger()->logCall(
                $url,
                '',
                $method,
                $time,
                $this->fixHeaders($headers),
                $data,
                $result->getHeaders(),
                json_encode($result->getContent())
            );
        }

        return $result;
    }

    private function fixHeaders($headers)
    {
        $fixed = [];

        foreach ($headers as $name => $value)
        {
            $fixed[] = sprintf('%s: %s', $name, $value);
        }

        return $fixed;
    }
}
