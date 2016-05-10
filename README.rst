API Logger Bundle
=================

API logger bundle help your app with API calls monitoring.

Installation
------------

Via composer:

.. code-block:: json

    {
        "require-dev": {
            "nixilla/api-logger-bundle": "~0.3"
        }
    }


Add bundle to your AppKernel:

.. code-block:: php

    <?php

    // app/AppKernel.php

    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
        // your other dev bundles here
        $bundles[] = new Nixilla\Api\LoggerBundle\NixillaApiLoggerBundle();
    }

If you're use HWIOAuthBundle and you want to monitor all OAuth API calls, you can now override default
`hwi_oauth.http_client` service used by this bundle by adding this few lines to your config_dev.yml file

.. code-block:: yaml

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


If you're using `sensio/buzz-bundle`, you may want to override the `buzz.client` in config_dev.yml

.. code-block:: yaml

    # app/config/config_dev.yml
    imports:
        - { resource: config.yml }

    parameters:
        buzz.client.class: Nixilla\Api\LoggerBundle\Proxy\Buzz\Client\Curl

    services:
        buzz.client:
            class: %buzz.client.class%
            calls:
                - [ "setTimeout", [ "%buzz.client.timeout%" ] ]
                - [ "setLogger", [ "@nixilla.api.logger" ] ]

