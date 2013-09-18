<?php

namespace Nixilla\Api\LoggerBundle\Logger;
use Psr\Log\LoggerInterface;

class ApiLogger implements Api
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


    public function __construct(LoggerInterface $logger, $debug = false)
    {
        $this->logger = $logger;
        $this->debug = $debug;
    }

    public function logCall($path, $method, $time, $fromCache = false)
    {
        if($this->debug)
        {
            $this->calls[] = [
                'path' => $path,
                'method' => $method,
                'time' => $time,
                'from_cache' => $fromCache
            ];
        }

        if(null !== $this->logger)
        {
            $this->logger->info(sprintf("%s (%s) %0.2f ms, cached: %s", $path, $method, $time * 1000, $fromCache ? 'true' : 'false'));
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