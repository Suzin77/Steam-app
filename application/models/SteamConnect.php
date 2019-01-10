<?php
use GuzzleHttp\Client;

class SteamConnect extends Model
{

    public function startConnect()
    {
        $connection = new Client(['base_uri'=>'https://store.steampowered.com/api/appdetails?appids=3900']);
        $response = $connection->request('GET','https://store.steampowered.com/api/appdetails?appids=3900');
        $statusCode = $response->getStatusCode();
        return $response;
    }

    public function getBody($response)
    {
        return $response->getBody();
    }
}