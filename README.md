Khaos_Control_PHP_Library
=========================

Simple wrapper for Khaos Control API in PHP.

Example Code
---------------
Create a Connection
```php
$Service = new Khaos('https://KhaosServer/KhaosIDS.exe/wsdl/IKosWeb');
```

Export Stock (Single SKU)
```php
$Service = new Khaos('https://KhaosServer/KhaosIDS.exe/wsdl/IKosWeb');
$Service->ExportStock('SKU001');
```

Export Stock  (Array of SKUs)
```php
$MySkus = array(
                'SKU001',
                'SKU002',
                'SKU003'
                );
$Service = new Khaos('https://KhaosServer/KhaosIDS.exe/wsdl/IKosWeb');
$Service->ExportStock($MySkus);
```
