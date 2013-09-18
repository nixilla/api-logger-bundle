API Logger Bundle
=================

API logger bundle help your app with API calls monitoring.

Installation
------------
Via composer:
```
#!js
{
    "require": {
        "nixilla/api-logger-bundle": "dev-master"
    }
}
```

Add bundle to your AppKernel:

```
#!php

        $bundles = array(
            // your other bundles
            new Nixilla\Api\LoggerBundle\NixillaApiLoggerBundle()
        );
```

If you have a service object in your project that calls API, you need to wrap it with proxy class provided.

```
#!yml

services:
    consumer:
        # your API consumer definition

    consumer.proxy:
        class: Nixilla\Api\LoggerBundle\Proxy\Api
        arguments: [ @consumer ]
        calls:
            - [ setLogger, [ @nixilla.api.logger ]]
```

From now, use `@consumer.proxy` everywhere and all calls to consumer object will be logged and visible in Symfony profiler.

