<?php

namespace spec\Nixilla\Api\LoggerBundle\Proxy\Buzz\Client;

use Nixilla\Api\LoggerBundle\Logger\ApiInterface;
use Nixilla\Api\LoggerBundle\Proxy\Buzz\Client\Curl;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CurlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Curl::class);
    }

    function it_can_have_logger(ApiInterface $logger)
    {
        $this->setLogger($logger)->shouldReturn($this);
    }
}
