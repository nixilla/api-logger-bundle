<?php

namespace Nixilla\Api\LoggerBundle\Proxy;

use Buzz\Client\Curl;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Nixilla\Api\LoggerBundle\Logger\ApiLogger;
use Nixilla\Api\LoggerBundle\Traits\Log;

class Buzz extends Curl
{
    use Log;

    /**
     * @var ApiLogger
     */
    protected $logger;

    public function setLogger(ApiLogger $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    public function send(RequestInterface $request, MessageInterface $response, array $options = array())
    {
        $start = microtime(true);

        $result = parent::send($request, $response, $options);

        if($this->hasLogger())
        {
            $time = microtime(true) - $start;
            parse_str($request->getContent(), $payload);
            $this->getLogger()->logCall(
                $request->getResource(),
                $request->getMethod(),
                $time, $request->getHeaders(),
                $payload, $response->getHeaders(),
                $response->getContent()
            );
        }

        return $result;
    }
}