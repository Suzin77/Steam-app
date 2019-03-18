<?php
use GuzzleHttp\CLient;
use GuzzleHttp\Psr7\Request;

class Guzz extends Controller
{
    public function index()
    {
        $base_uri = "https://store.steampowered.com/api/appdetails?appids=237370";
        //$guzz = $this->loadModel('steamconnect');
        $guzzClient = new Client(['base_uri'=>$base_uri]);

        $request = new Request('GET', 'https://store.steampowered.com/api/appdetails?appids=237370');
        $response = $guzzClient->send($request, ['timeout' => 2]);
        var_dump($response->getStatusCode());
        $body = $response->getBody()->getContents();

        $title = 'rrrtrtrtrtr';
        $loader = new Twig_Loader_Filesystem('application/views/_templates');
        $twig = new Twig_Environment($loader);

        $products = [
            [
                'name'          => 'Notebook',
                'description'   => 'Core i7',
                'value'         =>  800.00,
                'date_register' => '2017-06-22',
            ],
            [
                'name'          => 'Mouse',
                'description'   => 'Razer',
                'value'         =>  125.00,
                'date_register' => '2017-10-25',
            ],
            [
                'name'          => 'Keyboard',
                'description'   => 'Mechanical Keyboard',
                'value'         =>  250.00,
                'date_register' => '2017-06-23',
            ],
        ];
        
        // Render our view
        echo $twig->render('header.php');
        echo $twig->render('twig-example.php', ['products' => $products] );
        //var_dump($loader);
        //include 'application/views/_templates/twig-example.php';
        include 'application/views/_templates/footer.php';
        
    }

    public function ajaxtest()
    {
        $base_uri = "http://localhost/bawialnia/app/ajax/loadgame.php";

        $guzzClient = new Client(['base_uri'=>$base_uri]);

        $request = new Request('GET', 'https://store.steampowered.com/api/appdetails?appids=237370');
        //$request = new Request('GET', $base_uri);
        $response = $guzzClient->send($request);
        $getContent = $response->getBody()->getContents();
        $json = json_decode($getContent,true);
        var_dump($json['237370']);
        var_dump($json);
        //$body = $response->getBody()->getContents();
    }
}