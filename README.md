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

    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
        // your other dev bundles
        $bundles[] = new Nixilla\Api\LoggerBundle\NixillaApiLoggerBundle();
    }
```
