<?php

namespace spec\Nixilla\Api\LoggerBundle\Proxy\Twilio;

use Nixilla\Api\LoggerBundle\Logger\ApiInterface;
use Nixilla\Api\LoggerBundle\Proxy\Twilio\CurlClient;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CurlClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CurlClient::class);
    }

    function it_monitors_http_requests(ApiInterface $logger)
    {
        $this->setLogger($logger);

        $logger->logCall(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->shouldBeCalled()
        ;

        $this->request('GET', 'http://packagist.org', [], [], ['Content-Type' => 'text/plain'])->shouldNotReturn(null);
    }
}
