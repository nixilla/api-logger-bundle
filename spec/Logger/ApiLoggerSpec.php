<?php

namespace spec\Nixilla\Api\LoggerBundle\Logger;

use Nixilla\Api\LoggerBundle\Logger\ApiInterface;
use Nixilla\Api\LoggerBundle\Logger\ApiLogger;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;

class ApiLoggerSpec extends ObjectBehavior
{
    function let(LoggerInterface $logger)
    {
        $this->beConstructedWith($logger, true);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ApiLogger::class);
        $this->shouldHaveType(ApiInterface::class);
    }

    function it_can_log_calls()
    {
        $this->logCall('test.local', '/some/path', 'GET', 0.02);
        $this->getCalls()->shouldHaveCount(1);
        $this->getCallsCount()->shouldReturn(1);
    }
}
