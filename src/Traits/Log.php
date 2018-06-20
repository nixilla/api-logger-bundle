<?php

namespace Nixilla\Api\LoggerBundle\Traits;

use Nixilla\Api\LoggerBundle\Logger\ApiInterface;

trait Log
{
    /** @var ApiInterface */
    protected $logger;

    public function getLogger()
    {
        return $this->logger;
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;

        return $this;
    }


    public function hasLogger()
    {
        return $this->logger !== null;
    }
}
