# aimedidierm/fdisms

This is a php library to help developers include sms service, with FDI sms gateway from Rwanda.

## Installation

Install this package as a dependency using [Composer](https://getcomposer.org).

```bash
composer require aimedidierm/fdisms
```

## Usage

This is the documantion

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Aimedidierm\FdiSms\SendSms;

$to = ""; // Receiver phone number
$message = "";  // Text message to be send
$senderId = ""; // Your User ID provided by FDI
$ref = "";  // Your unique message reference ID
$callbackUrl = "";  //Optional Delivery Report destination

try {
$apiUsername = "";  // Your API Username provided by FDI
$apiPassword = "";  // Your API Password provided by FDI
$smsSender = new SendSms($apiUsername, $apiPassword);

$response = $smsSender->sendSms($to, $message, $senderId, $ref, $callbackUrl);

if ($response['success']) {
return response()->json(['message' => 'SMS sent successfully']);
} else {
return response()->json(['message' => $response['message'], 500]);
}
} catch (\Exception $e) {
return response()->json(['message' => $e->getMessage()], 500);
}

```

NB: For some people who are not using composer remember to add:

```php
include_once("../vendor/autoload.php");
```

## Contributing

Contributions are welcome! Before contributing to this project, familiarize
yourself with [CONTRIBUTING.md](CONTRIBUTING.md).

To develop this project, you will need [PHP](https://www.php.net) 8.1 or greater,
[Composer](https://getcomposer.org),

After cloning this repository locally, execute the following commands:

```bash
cd /path/to/repository
composer install
```

Now, you are ready to develop!

## Copyright and License

The aimedidierm/fdisms library is free and unencumbered software released into the
public domain. Please see [MITLICENCE](MITLICENCE) for more information.
