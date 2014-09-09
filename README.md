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

Arguments
---------------
Arguments should be passed into the methods as multidimensional arrays.

```php
$args = array('foo' => array('bar',
                                'baz'),
                'qux' => true);

$khaosApiClient->doSomething($args);
```

You'll need to see the relevant Class and Khaos documentation to understand which Classes accept which arguments.

Internal Class API
---------------
This library has been designed to have one Class per Khaos API method. All of the Classes reside within the <code>KhaosAPI/Caller/</code> directory.

Classes have the same (title cased) name as the SOAP method it's calling. So, if the SOAP method is called GetStockList then the Class will be named GetStockList.php <code>KhaosAPI/Caller/GetStockList.php</code>.

**These Classes are called** ***Callers.***

For example; to execute the GetStockList Caller you do so via a <code>KhaosApi\Client</code> instance variable. See example below:

```php
$khaosApiClient->getStockList($args);
```

When you execute Callers you reference them in camel case. Not title case. Calling a Caller will execute the <code>run</code> method within that particular Class.

Therefore...

```php
$khaosApiClient->getStockList($args);
```

...will result in executing <code>KhaosAPI/Caller/GetStockList::run()</code>


Calling bespoke Khaos API methods
---------------

To call a bespoke SOAP method you will first need to create a Caller (Class) that handles the request. Your Class must extend \KhaosAPI\Caller\CallerAbstract

So for example, if you wanted to call a Khaos method called <code>DoSomething</code> you could do it like so:

```php
namespace MyNamespace
{   
    class DoSomething extends \KhaosAPI\Caller\CallerAbstract
    {
        public function run()
        {   
            return $this->getClient()->DoSomething(); // This is the call to the SOAP method DoSomething.
        }
    }
}
```

You would then call your Class like this:
```php
$soapClient = new SoapClient('https://KhaosServer/KhaosIDS.exe/wsdl/IKosWeb');

$khaosApiClient = new KhaosApi\Client($soapClient);

// Register your class
$khaosApiClient->registerCaller(new \MyNamespace\DoSomething);

// Call DoSomething::run
$stockXML = $khaosApiClient->doSomething();
```

To access supplied arguments within your Caller use the <code>getArgs()</code> method.

```php
namespace MyNamespace
{   
    class DoSomething extends \KhaosAPI\Caller\CallerAbstract
    {
        public function run()
        {   
            $this->getArgs()->myKey; // $args['myKey']
        }
    }
}
```

Calling methods with differing SoapClient instances.
---------------

You can also choose to call SOAP methods using a different SoapClient instance if you wish. The second argument of each method call can accept a SoapClient instance to use just for that request.

```php
$args = array('qux' => true);

$newSoapClient = new SoapClient('https://KhaosServer/KhaosIDS.exe/wsdl/IKosWeb');

$khaosApiClient->doSomething($args, $newSoapClient);
```
