<?php
use GuzzleHttp\Client;

class SteamConnect extends Model
{

    public function connect()
    {
        $connection = new Client(['base_uri'=>'http://www.wp.pl']);
        $response = $connection->get();
        return $response;
    }
}