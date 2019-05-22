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
            'curl -v -X %s%s %s%s%s',
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

        foreach($request_headers as $key => $value)
        {
            $output .= sprintf(' -H "%s: %s"', $key, is_array($value) ? $value[0] : $value);
        }

        return $output;
    }

    private function formatParams($singleCall)
    {
        if($singleCall['method'] != 'GET')
        {
            foreach($singleCall['request_headers'] as $header)
            {
                if($header == 'Content-Type: application/json')
                {
                    return sprintf(" --data '%s'", json_encode($singleCall['params']));
                }
            }

            return sprintf(" --data '%s'", http_build_query($singleCall['params']));
        }
        else
        {
            return '';
        }
    }
}
