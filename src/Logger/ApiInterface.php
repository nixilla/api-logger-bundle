<?php

namespace Nixilla\Api\LoggerBundle\Logger;

interface ApiInterface
{
    public function logCall($host, $path, $method, $time, array $requestHeaders = [], array $params = [], array $responseHeaders = [], $result = null);

    /** @return array */
    public function getCalls();

    /** @return int */
    public function getCallsCount();
}