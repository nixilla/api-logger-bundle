<?php

namespace spec\Nixilla\Api\LoggerBundle\Twig;

use Nixilla\Api\LoggerBundle\Twig\CurlFormatter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CurlFormatterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CurlFormatter::class);
    }

    function it_provides_Twig_filter_which_formats_input_into_curl_command()
    {
        $this->formatForCurl([
            'host' => 'http://endpoint/',
            'path' => 'api/endoint',
            'method' => 'POST',
            'params' => ['foo' => 'bar', 'baz' => 1],
            'request_headers' => [ 'Authorization' => [ 'Bearer lakdjfghalkdjfgh'] ]
        ])->shouldBeEqualTo("curl -v -X POST -H \"Authorization: Bearer lakdjfghalkdjfgh\" http://endpoint/api/endoint --data 'foo=bar&baz=1'");

        $this->formatForCurl([
            'host' => 'http://endpoint/',
            'path' => 'api/endoint',
            'method' => 'PATCH',
            'params' => ['foo' => 'bar', 'baz' => ['key' => 'value']],
            'request_headers' => [ 'Authorization' => ['Bearer lakdjfghalkdjfgh'], 'Content-Type' => [ 'application/json' ]]
        ])->shouldBeEqualTo("curl -v -X PATCH -H \"Authorization: Bearer lakdjfghalkdjfgh\" -H \"Content-Type: application/json\" http://endpoint/api/endoint --data '{\"foo\":\"bar\",\"baz\":{\"key\":\"value\"}}'");

        $this->formatForCurl([
            'host' => 'http://endpoint/',
            'path' => 'api/endoint',
            'method' => 'GET',
            'params' => ['foo' => 'bar', 'baz' => ['key' => 'value']],
            'request_headers' => [ 'Authorization' => ['Bearer lakdjfghalkdjfgh'], 'Content-Type' => [ 'application/json' ]]
        ])->shouldBeEqualTo("curl -v -X GET -H \"Authorization: Bearer lakdjfghalkdjfgh\" -H \"Content-Type: application/json\" http://endpoint/api/endoint");
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
