<?php

namespace spec\Nixilla\Api\LoggerBundle;

use Nixilla\Api\LoggerBundle\NixillaApiLoggerBundle;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NixillaApiLoggerBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Nixilla\Api\LoggerBundle\NixillaApiLoggerBundle');
    }

    function it_should_be_a_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }
}
