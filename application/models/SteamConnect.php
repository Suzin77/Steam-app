<?php
use GuzzleHttp\Client;

class SteamConnect extends Model
{
    
    public function createGuzzClient($base_uri)
    {
        $guzzClient = new Client(['base_uri'=>$base_uri]);
        return $guzzClient;
    }

    public function getResponseStatusCode($guzzClient)
    {
        
        $response = $guzzClient->request('GET','https://store.steampowered.com/api/appdetails?appids=3900');
        $statusCode = $response->getStatusCode();
        $statusCode = 200;
        return $statusCode;
    }

    public function getGuzzresponseCode(){

    }

    public function getBody($response)
    {
        return $response->getBody();
    }
}