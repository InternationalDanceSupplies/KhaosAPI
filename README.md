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