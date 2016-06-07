<?php

namespace Nixilla\Api\LoggerBundle\Twig;

class CurlFormatter extends \Twig_Extension
{
    public function getName()
    {
        return 'nixilla_api_logger';
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('format_curl_command', array($this, 'formatForCurl'))
        );
    }

    public function formatForCurl(array $singleCall)
    {
        return "";
    }
}
