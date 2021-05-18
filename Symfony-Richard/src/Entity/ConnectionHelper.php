<?php
namespace App\Entity;
use GuzzleHttp\Client;


class ConnectionHelper{

    protected $client;

    function __construct(string $base_uri = "http://localhost:8002")
    {
        $this->client = new Client([
            "base_uri" => $base_uri,
            "timeout" => 2.0,
        ]);
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getRequest(string $endpoint = "/")
    {
        $response = $this->client->request("GET", $endpoint);
        return $response;
    }

    public function postRequest(string $endpoint = "/", array $json)
    {
        $response = $this->client->request("POST", $endpoint, ["json" => $json]);
        return $response;
    }

}