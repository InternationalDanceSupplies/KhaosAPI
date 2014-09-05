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

$stock = $khaosApiClient->export()->stock($args);
```