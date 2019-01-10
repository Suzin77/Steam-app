<?php
use GuzzleHttp\CLient;

class Guzz extends Controller
{
    public function index()
    {
        $guzz = $this->loadModel('steamconnect');
        //$client = $guzz->createGuzzClient('http://localhost/MVC/SteamMVC/main');
        $client = $guzz->createGuzzClient('https://store.steampowered.com/api/appdetails?appids=3900');
        $response = $client->request('GET','https://store.steampowered.com/api/appdetails?appids=3900');
        //$response = $client->request('GET','http://localhost/MVC/SteamMVC/main');
        $page = json_decode($response->getBody());
        var_dump($client);
        var_dump($response);
        var_dump($page);
        
    }
}