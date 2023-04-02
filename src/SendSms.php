<?php

namespace Aimedidierm\FdiSms;

class SendSms
{
    private function authFDISMS($SMSSECRET, $SMSID)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://messaging.fdibiz.com/api/v1/auth/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
        \"api_username\": $SMSID,
        \"api_password\": $SMSSECRET
        }");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
    }

    public function SingleSms($username, $password, $sender_id, $phone, $message, $ref, $callBackURL)
    {
        $auth = $this->authFDISMS($password, $username);
        $token = $auth['access_token'];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://messaging.fdibiz.com/api/v1/mt/single");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
        \"msisdn\": $phone,
        \"message\": $message,
        \"msgRef\": $ref,
        \"dlr\": $callBackURL,
        \"sender_id\": $sender_id
        }");

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
