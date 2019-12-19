Factomos is an invoicing tool (B2B SaaS) available at [https://factomos.com].
This library is a PHP Client for the Factomos API. With it you can create invoices, estimates, send them, etc ...

The full API documentation is available at [https://factomos.docs.apiary.io/]

Installation
============

Official installation method is via composer and its packagist package [factomos/factomos-php](https://packagist.org/packages/factomos/factomos-php).

```
$ composer require factomos/factomos-php
```

Usage
=====

The simplest usage of the library would be as follows:

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$factomosApiToken = 'my-api-token';

$factomosClient = new Factomos\Client([
    'FACTOMOS_API_TOKEN' => $factomosApiToken,
]);

$myInvoicesList = $factomosClient->listInvoices();

```