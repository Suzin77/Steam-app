<?php
use GuzzleHttp\CLient;

class Guzz extends Controller
{
    public function index()
    {
        $guzz = $this->loadModel('steamconnect');
        //$client = $guzz->createGuzzClient('http://localhost/MVC/SteamMVC/main');
        $client = $guzz->createGuzzClient('https://store.steampowered.com/api/appdetails?appids=237370');
        $response = $client->request('GET','https://store.steampowered.com/api/appdetails?appids=237370');
        //$response = $client->request('GET','http://localhost/MVC/SteamMVC/main');
        $page = json_decode($response->getBody());

        $title = 'rrrtrtrtrtr';
        //var_dump($client);
        //var_dump($response);
        //var_dump($page);
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
}