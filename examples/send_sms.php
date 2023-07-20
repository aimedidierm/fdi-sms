<?php
use Aimedidierm\FdiSms\SendSms;

public function testing()
{
$to = "";
$message = "";
$senderId = "";
$ref = "";
$callbackUrl = "";

try {
$apiUsername = "";
$apiPassword = "";
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
}