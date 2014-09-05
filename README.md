Keystone Khaos API Library
=========================

Example Usage
---------------
```php
$soapClient = new SoapClient('https://KhaosServer/KhaosIDS.exe/wsdl/IKosWeb');

$khaosApiClient = new KhaosApi\Client($soapClient);

$args = array('stockCode' => array('SKU001',
                                    'SKU002',
                                    'SKU003'));

$stockXML = $khaosApiClient->exportStock($args);
```

Loading the library
---------------

This library is designed to the PSR-0 specification and can therefore ultilise the SplClassLoader Class.

The SplClassLoader Class can be found here: [http://www.php-fig.org/psr/psr-0/](http://www.php-fig.org/psr/psr-0/)

The PSR-0 specification is located here: [http://www.php-fig.org/psr/psr-0/](http://www.php-fig.org/psr/psr-0/)

```php

/**
 * Assumes this library is installed at this location: /path/to/lib/KhaosAPI/
 */

// Include the autoloader
require 'SplClassLoader.php';

// Create an instance of the autoloader referencing your parent library folder.
$classLoader = new SplClassLoader(null, '/path/to/lib/');

// register the autoloader.
$classLoader->register();
```

Calling bespoke Khaos API methods
---------------

To call a bespoke API method you will first need to create a class that handles the call. Your class must extend \KhaosAPI\Caller\CallerAbstract

So for example, if you wanted to call a Khaos method called <code>DoSomething</code> you could do it like so:

```php
namespace MyNamespace
{   
    class DoSomething extends \KhaosAPI\Called\CallerAbstract
    {
        public function run()
        {   
            return $this->getClient()->DoSomething(); // This is the call to the endpoint
        }
    }
}
```

You would then call it like this:
```php
$soapClient = new SoapClient('https://KhaosServer/KhaosIDS.exe/wsdl/IKosWeb');

$khaosApiClient = new KhaosApi\Client($soapClient);

// Register your class
$khaosApiClient->registerCaller(new \MyNamespace\DoSomething);

// Call DoSomething::run
$stockXML = $khaosApiClient->doSomething($args);
```

Arguments
---------------
Documentation coming soon.
