<?php

namespace spec\Nixilla\Api\LoggerBundle\Proxy\Buzz\Client;

use Buzz\Message\RequestInterface;
use Buzz\Message\Response;
use Nixilla\Api\LoggerBundle\Logger\ApiInterface;
use Nixilla\Api\LoggerBundle\Proxy\Buzz\Client\FileGetContents;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileGetContentsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FileGetContents::class);
    }

    function it_can_have_logger(ApiInterface $logger)
    {
        $this->setLogger($logger)->shouldReturn($this);
        $this->hasLogger()->shouldReturn(true);
        $this->getLogger()->shouldReturn($logger);
    }

    function it_can_send_request(ApiInterface $logger, RequestInterface $request, Response $response)
    {
        $this->setLogger($logger);

        $request->getHeaders()->willReturn([]);
        $request->getMethod()->willReturn('GET');
        $request->getContent()->shouldBeCalled();
        $request->getProtocolVersion()->shouldBeCalled();
        $request->getHost()->willReturn('https://google.com');
        $request->getResource()->shouldBeCalled();
        $request->getHeader(Argument::any())->shouldBeCalled();

        $response->getHeaders()->willReturn([]);
        $response->setHeaders(Argument::any())->shouldBeCalled();
        $response->setContent(Argument::any())->shouldBeCalled();
        $response->getContent()->shouldBeCalled();

        $this->send($request, $response);

        $request->getHeader('Content-Type')->willReturn('application/json');
        $this->send($request, $response);

    }
}
