<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Aimedidierm\FdiSms\SendSms;

$sms = new SendSms();
$sms->SingleSms(
    $username = "", // Your API Username provided by FDI
    $password = "", // Your API Password provided by FDI
    $sender_id = "", // Your User ID provided by FDI
    $phone = "", // Receiver phone number
    $message = "", // Text message to be sent
    $ref = "", // Your unique message reference ID
    $callBackURL = "" // Optional Delivery Report destination
);
var_dump($sms);
