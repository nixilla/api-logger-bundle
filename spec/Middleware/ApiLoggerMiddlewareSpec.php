<?php

namespace spec\Nixilla\Api\LoggerBundle\Middleware;

use Buzz\Middleware\MiddlewareInterface;
use Nixilla\Api\LoggerBundle\Logger\ApiInterface;
use Nixilla\Api\LoggerBundle\Middleware\ApiLoggerMiddleware;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class ApiLoggerMiddlewareSpec extends ObjectBehavior
{
    function let(ApiInterface $logger)
    {
        $this->beConstructedWith($logger);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ApiLoggerMiddleware::class);
        $this->shouldHaveType(MiddlewareInterface::class);
    }

    function it_can_handle_request(RequestInterface $request)
    {
        $next = function() {
            return;
        };

        $this->handleRequest($request, $next);
    }

    function it_can_handle_response(RequestInterface $request, ResponseInterface $response, UriInterface $uri)
    {
        $next = function() {
            return;
        };

        $request->getUri()->willReturn($uri);
        $request->getHeader(Argument::any())->shouldBeCalled();
        $request->getHeaders()->willReturn([]);
        $request->getBody()->willReturn('key=value&some=value');
        $request->getMethod()->shouldBeCalled();

        $response->getHeaders()->willReturn([]);
        $response->getBody()->willReturn('[]');

        $this->handleResponse($request, $response, $next);
    }

    function it_can_handle_response_with_json(RequestInterface $request, ResponseInterface $response, UriInterface $uri)
    {
        $next = function() {
            return;
        };

        $request->getUri()->willReturn($uri);
        $request->getHeader('Content-Type')->willReturn('application/json');
        $request->getHeaders()->willReturn([]);
        $request->getBody()->willReturn('{"key":"value"}');
        $request->getMethod()->shouldBeCalled();

        $response->getHeaders()->willReturn([]);
        $response->getBody()->willReturn('[]');

        $this->handleResponse($request, $response, $next);
    }


}
