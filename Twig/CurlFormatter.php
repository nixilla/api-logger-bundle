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
        return sprintf(
            'curl -X %s%s %s/%s --data \'%s\'',
            $singleCall['method'],
            $this->generateHeaders($singleCall['request_headers']),
            $singleCall['host'],
            $singleCall['path'],
            $this->formatParams($singleCall)
        );
    }

    private function generateHeaders($request_headers)
    {
        $output = '';

        foreach($request_headers as $value)
        {
            $output .= sprintf(' -H "%s"', $value);
        }

        return $output;
    }

    private function formatParams($singleCall)
    {
        foreach($singleCall['request_headers'] as $header)
        {
            if($header == 'Content-Type: application/json')
            {
                return json_encode($singleCall['params']);
            }
        }

        return http_build_query($singleCall['params']);
    }
}
