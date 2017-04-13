<?php

namespace App\Domain\Api;

use Symfony\Component\HttpFoundation\Session\Session;

class CurlClient implements ClientInterface
{
    private $apiKey;

    public function __construct($apiKey, Session $session)
    {
        $this->apiKey = $apiKey;
        $this->session = $session;
    }

    public function getMemberInformations()
    {
        $response = $this->get('http://api.betaseries.com/members/infos');
        $json = json_decode($response, true);

        if (count($json['errors']) > 0) {
            return null;
        }

        return $json['member'];
    }

    private function get($address)
    {
        $curling = curl_init();

        curl_setopt($curling, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curling, CURLOPT_URL, $address);
        curl_setopt($curling, CURLOPT_HEADER, 0);
        curl_setopt($curling, CURLOPT_HTTPHEADER, [
            'X-BetaSeries-Key: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->session->get('token'),
        ]);

        $output = curl_exec($curling);
        curl_close($curling);

        return $output;
    }
}
