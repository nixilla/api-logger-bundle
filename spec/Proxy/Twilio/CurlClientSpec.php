<?php

namespace spec\Nixilla\Api\LoggerBundle\Proxy\Twilio;

use Nixilla\Api\LoggerBundle\Proxy\Twilio\CurlClient;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CurlClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CurlClient::class);
    }
}
