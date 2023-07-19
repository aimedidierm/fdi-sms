<?php

namespace Aimedidierm\FdiSms;

use Exception;

class SendSms
{
    private function authFDISMS($SMSSECRET, $SMSID)
    {
        if (empty($SMSSECRET)) {
            throw new Exception("SMSSECRET is required.");
        }
        if (empty($SMSID)) {
            throw new Exception("SMSID is required.");
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://messaging.fdibiz.com/api/v1/auth/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "api_username" => $SMSID,
            "api_password" => $SMSSECRET
        ]));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $decodedResponse = json_decode($response, true);
        return $decodedResponse;
    }

    public function SingleSms($username, $password, $sender_id, $phone, $message, $ref, $callBackURL)
    {
        if (empty($username)) {
            throw new Exception("Username is required.");
        }
        if (empty($password)) {
            throw new Exception("Password is required.");
        }
        if (empty($phone)) {
            throw new Exception("Phone number is required.");
        }
        if (empty($message)) {
            throw new Exception("Message is required.");
        }
        if (empty($ref)) {
            throw new Exception("Reference is required.");
        }

        $auth = $this->authFDISMS($password, $username);
        $token = $auth["access_token"];
        var_dump($token);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://messaging.fdibiz.com/api/v1/mt/single");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "msisdn" => $phone,
            "message" => $message,
            "msgRef" => $ref,
            "dlr" => $callBackURL,
            "sender_id" => $sender_id
        ]));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization" => "Bearer " . $token
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
    }
}
