# API Logger Bundle

[![Version](https://img.shields.io/packagist/v/nixilla/api-logger-bundle.svg?style=flat-square)](https://packagist.org/packages/nixilla/api-logger-bundle)
[![Build Status](https://travis-ci.org/nixilla/api-logger-bundle.svg?branch=develop)](https://travis-ci.org/nixilla/api-logger-bundle)
[![Coverage Status](https://coveralls.io/repos/github/nixilla/api-logger-bundle/badge.svg?branch=develop)](https://coveralls.io/github/nixilla/api-logger-bundle?branch=develop)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nixilla/api-logger-bundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/nixilla/api-logger-bundle/?branch=develop)
[![License](https://poser.pugx.org/nixilla/api-logger-bundle/license.svg)](https://packagist.org/packages/nixilla/api-logger-bundle)

## Installation

Step 1: composer

```bash
composer require nixilla/api-logger-bundle
```

Step 2: enable bundle by adding it to AppKernel


```php
<?php

    // app/AppKernel.php

    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
        // your other dev bundles here
        $bundles[] = new Nixilla\Api\LoggerBundle\NixillaApiLoggerBundle();
    }

```

Step 3: configuration

If you're use HWIOAuthBundle and you want to monitor all OAuth API calls, you can now override default
`hwi_oauth.http_client` service used by this bundle by adding this few lines to your `config_dev.yml` file

```yaml
# app/config/config_dev.yml
imports:
    - { resource: config.yml }

parameters:
    buzz.client.class: Nixilla\Api\LoggerBundle\Proxy\Buzz\Client\Curl

services:
    hwi_oauth.http_client:
        class: "%buzz.client.class%"
        calls:
            - [ "setLogger", [ "@nixilla.api.logger" ] ]
```

If you're using `sensio/buzz-bundle`, you may want to override the `buzz.client` in config_dev.yml

```yaml
# app/config/config_dev.yml
imports:
    - { resource: config.yml }

parameters:
    buzz.client.class: Nixilla\Api\LoggerBundle\Proxy\Buzz\Client\Curl

services:
    buzz.client:
        class: "%buzz.client.class%"
        calls:
            - [ "setTimeout", [ "%buzz.client.timeout%" ] ]
            - [ "setLogger", [ "@nixilla.api.logger" ] ]
```

If you're using `twilio/sdk` you may want to override their Http Client in config_dev.yml

```yaml
# app/config/config_dev.yml
imports:
    - { resource: config.yml }

services:
    
    twilio.http.client:
        class: Nixilla\Api\LoggerBundle\Proxy\Twilio\CurlClient
        calls:
            - [ "setLogger", [ "@nixilla.api.logger" ] ]
            
    twilio.rest.client:
        class: Twilio\Rest\Client
        arguments: [ "%twilio.username%", "%twilio.password%", ~, ~, '@twilio.http.client']

```