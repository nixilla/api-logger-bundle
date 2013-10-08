<?php

namespace Nixilla\Api\LoggerBundle\Proxy\Buzz\Client;

use Buzz\Client\Curl as BaseCurl;
use Nixilla\Api\LoggerBundle\Proxy\Buzz\Common;

class Curl extends BaseCurl
{
    use Common;
}