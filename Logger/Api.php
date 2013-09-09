<?php

namespace Nixilla\Api\LoggerBundle\Logger;

interface Api
{
    /**
     * @return integer
     */
    public function getCalls();

    /**
     * @return array
     */
    public function getCallsCount();
}