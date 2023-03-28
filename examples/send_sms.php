<?php

namespace Aimedidierm\FdiSms;

$sms = new SendSms;
$sms->SingleSms(
    $username = "", // Your API Username provided by FDI
    $password = "", // Your API Password provided by FDI
    $sender_id = "", // Your User ID provided by FDI
    $phone = "", // Receiver phone number
    $message = "", // Text message to be send
    $ref = "" // Your unique message reference ID
);
echo $sms;
