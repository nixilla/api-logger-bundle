<?php

namespace spec\Nixilla\Api\LoggerBundle\Twig;

use Nixilla\Api\LoggerBundle\Twig\CurlFormatter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CurlFormatterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Nixilla\Api\LoggerBundle\Twig\CurlFormatter');
    }

    function it_provides_Twig_filter_which_formats_input_into_curl_command()
    {
        $this->formatForCurl([])->shouldBeEqualTo("");
    }

    function it_has_a_name()
    {
        $this->getName()->shouldNotReturn(null);
    }

    function it_has_required_getFilters_method()
    {
        $this->getFilters()->shouldHaveCount(1);
    }
}
