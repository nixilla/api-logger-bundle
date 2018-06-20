<?php

namespace spec\Nixilla\Api\LoggerBundle;

use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Nixilla\Api\LoggerBundle\NixillaApiLoggerBundle;

class NixillaApiLoggerBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NixillaApiLoggerBundle::class);
        $this->shouldHaveType(Bundle::class);
    }
}
