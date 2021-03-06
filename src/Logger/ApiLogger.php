<?php

namespace Nixilla\Api\LoggerBundle\Logger;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ApiLogger implements ApiInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var array
     */
    protected $calls = [];

    /**
     * @var bool
     */
    protected $debug = false;


    public function __construct(LoggerInterface $logger = null, $debug = false)
    {
        $this->logger = $logger ?: new NullLogger();
        $this->debug = $debug;
    }

    public function logCall($host, $path, $method, $time, array $requestHeaders = [], array $params = [], array $responseHeaders = [], $result = null)
    {
        if($this->debug)
        {
            $this->calls[] = [
                'host' => $host,
                'path' => $path,
                'method' => $method,
                'time' => $time,
                'request_headers' => $requestHeaders,
                'params' => $params,
                'response_headers' => $responseHeaders,
                'result' => $result
            ];
        }

        if(null !== $this->logger)
        {
            $this->logger->info(sprintf("%s (%s) %0.2f ms, params: %s", $path, $method, $time * 1000, json_encode($params)));
        }
    }

    public function getCalls()
    {
        return $this->calls;
    }

    public function getCallsCount()
    {
        return count($this->calls);
    }
}