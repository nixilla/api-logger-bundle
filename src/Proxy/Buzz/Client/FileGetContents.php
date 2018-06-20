<?php

namespace Nixilla\Api\LoggerBundle\Proxy\Buzz\Client;

use Buzz\Client\FileGetContents as BaseFileGetContents;
use Nixilla\Api\LoggerBundle\Proxy\Buzz\Common;

class FileGetContents extends BaseFileGetContents
{
    use Common;
}