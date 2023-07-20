<?php

namespace Aimedidierm\FdiSms;

class sendSms
{
    private $baseUrl;
    private $bearerToken;

    public function __construct($apiUsername, $apiPassword)
    {
        $this->baseUrl = 'https://messaging.fdibiz.com/api/v1/';
        $this->bearerToken = $this->getBearerToken($apiUsername, $apiPassword);
    }

    private function getBearerToken($apiUsername, $apiPassword)
    {
        $ch = curl_init($this->baseUrl . 'auth/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'api_username' => $apiUsername,
            'api_password' => $apiPassword,
        ]));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        if (!$response) {
            throw new \Exception('Empty response from the API');
        }

        $responseData = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON response from the API');
        }

        if ($responseData === null || !isset($responseData['access_token'])) {
            throw new \Exception('Failed to get Bearer token');
        }

        return $responseData['access_token'];
    }

    public function sendSms($to, $message, $senderId, $ref, $callbackUrl)
    {
        if (empty($to)) {
            throw new \Exception("Receiver hone number is required.");
        }
        if (empty($message)) {
            throw new \Exception("Message is required.");
        }
        if (empty($ref)) {
            throw new \Exception("Reference is required.");
        }
        $data = [
            'msisdn' => $to,
            'message' => $message,
            'sender_id' => $senderId,
            'msgRef' => $ref,
            'dlr' => $callbackUrl,
        ];

        $ch = curl_init($this->baseUrl . 'mt/single');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->bearerToken,
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        if ($response == null) {
            throw new \Exception('Empty response from the API');
        }

        $responseData = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON response from the API');
        }

        if ($responseData['success']) {
            throw new \Exception($responseData['message']);
        }

        return $responseData;
    }
}
