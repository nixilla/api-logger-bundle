<?php

namespace Nixilla\Api\LoggerBundle\Middleware;

use Buzz\Middleware\MiddlewareInterface;
use Nixilla\Api\LoggerBundle\Logger\ApiInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiLoggerMiddleware implements MiddlewareInterface
{
    /** @var ApiInterface */
    private $logger;

    /** @var float */
    private $startTime;

    /**
     * ApiLoggerMiddleware constructor.
     *
     * @param ApiInterface $logger
     */
    public function __construct(ApiInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handleRequest(RequestInterface $request, callable $next)
    {
        $this->startTime = microtime(true);

        return $next($request);

    }

    public function handleResponse(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $time = microtime(true) - $this->startTime;

        if($request->getHeader('Content-Type') == 'application/json')
        {
            $payload = json_decode($request->getBody(), true) ?: [];
        }
        else {
            parse_str($request->getBody(), $payload);
        }

        $this->logger->logCall(
            sprintf('%s://%s', $request->getUri()->getScheme(), $request->getUri()->getHost()),
            $request->getUri()->getPath(),
            $request->getMethod(),
            $time,
            $request->getHeaders(),
            $payload,
            $response->getHeaders(),
            $response->getBody()->getContents()
        );

        return $next($request, $response);
    }
}
