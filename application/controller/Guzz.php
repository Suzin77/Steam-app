<?php
use GuzzleHttp\CLient;

class Guzz extends Controller
{
    public function index()
    {
        $data = $this->loadModel('steamconnect');
        $guzz = $data->startconnect();
        //$page = $this->getBody($guzz);
        var_dump($guzz);
        
    }
}