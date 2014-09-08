Keystone Khaos API PHP Library
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

Example of registering the autoloader to work with this library.

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

// Library can now be autoloaded like so:
$soapClient = new SoapClient('https://KhaosServer/KhaosIDS.exe/wsdl/IKosWeb');
$khaosApiClient = new KhaosApi\Client($soapClient);
```

Internal Class API
---------------
This library has been designed to have one Class per Khaos API endpoint. All of the Classes reside within the <code>KhaosAPI/Caller/</code> directory.

Classes will have the same (titled cased) name as the SOAP method it's calling. So, if the SOAP method is called GetStockList then the class will be called GetStockList.php.

**These Classes are called** ***Callers***

```
KhaosAPI/Caller/GetStockList.php
```

To execute this Caller you do so via a <code>KhaosApi\Client</code> instance variable. See example below.

```php
$khaosApiClient->getStockList($args);
```

When you execute Callers you reference them in camel case. Not title case. Calling a caller will execute the <code>run</code> method within that particular class.

Therefore...

```php
$khaosApiClient->getStockList($args);
```

...will result in executing KhaosAPI/Caller/GetStockList::run()


Calling bespoke Khaos API methods
---------------

To call a bespoke SOAP method you will first need to create a Class (Caller) that handles the call. Your Class must extend \KhaosAPI\Caller\CallerAbstract

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
$stockXML = $khaosApiClient->doSomething();
```

Arguments
---------------
Documentation coming soon.
