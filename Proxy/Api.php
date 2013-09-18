<?php

namespace Nixilla\Api\LoggerBundle\Proxy;

use Nixilla\Api\LoggerBundle\Traits\Log;

class Api
{
    use Log;

    protected $logger;

    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __call($name, $arguments)
    {
        if(method_exists($this->client, $name))
        {
            $start = microtime(true);

            $result = call_user_func_array([ $this->client, $name], $arguments);

            if($this->hasLogger())
            {
                $time = microtime(true) - $start;
                $this->getLogger()->logCall($name, 'n\a', $time);
            }
            return $result;
        }
        else
            throw new \RuntimeException(sprintf('Method %s not found', $name));
    }
}