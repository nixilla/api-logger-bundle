<?php

namespace Nixilla\Api\LoggerBundle\DataCollector;

use Nixilla\Api\LoggerBundle\Logger\ApiInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class ApiDataCollector extends DataCollector
{
    /**
     * @var \Nixilla\Api\LoggerBundle\Logger\ApiInterface
     */
    protected $logger;

    /**
     * {@inheritDoc}
     */
    public function __construct(ApiInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data['calls'] = $this->logger->getCalls();
        $this->data['calls_count'] = $this->logger->getCallsCount();
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'api';
    }

    /**
     * {@inheritDoc}
     */
    public function getCalls()
    {
        return $this->data['calls'];
    }

    /**
     * {@inheritDoc}
     */
    public function getCallsCount()
    {
        return $this->data['calls_count'];
    }

    public function getTime()
    {
        $total = 0;
        foreach($this->data['calls'] as $call)
            $total += $call['time'];

        return $total;
    }

    public function reset()
    {
        $this->data = [];
    }

}