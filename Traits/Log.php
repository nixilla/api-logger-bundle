<?php

namespace Nixilla\Api\LoggerBundle\Traits;

trait Log
{

    public function setLogger($logger)
    {
        $this->logger = $logger;

        return $this;
    }

    public function getLogger()
    {
        return $this->logger;
    }

    public function hasLogger()
    {
        return $this->logger !== null;
    }
}
