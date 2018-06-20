<?php

namespace spec\Nixilla\Api\LoggerBundle\DataCollector;

use Nixilla\Api\LoggerBundle\DataCollector\ApiDataCollector;
use Nixilla\Api\LoggerBundle\Logger\Api;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class ApiDataCollectorSpec extends ObjectBehavior
{
    function let(Api $logger)
    {
        $this->beConstructedWith($logger);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ApiDataCollector::class);
        $this->shouldHaveType(DataCollector::class);
    }

    function it_implements_getName()
    {
        $this->getName()->shouldNotReturn(null);
    }

    function it_implements_collect_method(Api $logger, Request $request, Response $response)
    {
        $logger->getCalls()->shouldBeCalled()->willReturn([['time' => 5 ]]);
        $logger->getCallsCount()->shouldBeCalled()->willReturn(5);

        $this->collect($request, $response);

        $this->getCalls()->shouldNotReturn(null);
        $this->getCallsCount()->shouldReturn(5);

        $this->getTime()->shouldReturn(5);

        $this->reset();
    }
}
