# aimedidierm/fdisms

This is a php library to help developers include sms service, with FDI sms gateway from Rwanda.

## Installation

Install this package as a dependency using [Composer](https://getcomposer.org).

```bash
composer require aimedidierm/fdi-sms
```

## Usage

This is the documantion

```php
use Aimedidierm\FdiSms\SendSms;

$sms = new SendSms;
$sms->SingleSms(
    $username = "", // Your API Username provided by FDI
    $password = "", // Your API Password provided by FDI
    $sender_id = "", // Your User ID provided by FDI
    $phone = "", // Receiver phone number
    $message = "", // Text message to be send
    $ref = "", // Your unique message reference ID
    $callBackURL = "" //Optional Delivery Report destination
);
print_r($sms->SingleSms());

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
