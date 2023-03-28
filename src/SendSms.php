<?php

namespace Aimedidierm\FdiSms;

class SendSms
{
    private function authFDISMS($SMSSECRET, $SMSID)
    {
        $URL =  "https://messaging.fdibiz.com/api/v1/auth";
        $client =  new \GuzzleHttp\Client();
        $response = $client->post(
            $URL,
            [
                "json" =>  [
                    "api_username" => $SMSID,
                    "api_password" => $SMSSECRET
                ]
            ]
        );
        return json_decode($response->getBody(), true);
    }

    public function SingleSms($username, $password, $sender_id, $phone, $message, $ref)
    {
        $auth = $this->authFDISMS($password, $username);
        $token = $auth->access_token;
        return $token;
        $client = new \GuzzleHttp\Client(["headers" => ["Authorization" => "Bearer " . $token]]);
        $URL =  "https://messaging.fdibiz.com/api/v1/mt/single";
        $response = $client->post($URL, [
            "json" => [
                "sender_id" => $sender_id,
                "msisdn" => $phone,
                "message" => $message,
                "msgRef" => $ref
            ]
        ]);
        return json_decode($response->getBody(), true);
    }
}
