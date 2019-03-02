<?php
//namespace Data;

class Data extends Controller
{
	public function index()
	{
        
	}

	public function search()
	{
		$SteamAPISearchReadModel = $this->loadModel('SteamAPISearchReadModel');
		$steamUserModel = $this->loadModel('SteamUsersModel');
		$DataSearchReadModel = $this ->loadModel('DataSearchReadModel');
	    $users = $DataSearchReadModel->getUsers();	    
	    $statsModel = $this->loadModel('StatsModel');
	    $amount_of_users = $statsModel->getAmountOf('user_id','users');
	    $amountToCheck = $statsModel->getAmountOf('steam_id','steam_users_to_check');
	    $exampleToCheck = $DataSearchReadModel->getRandomRows('steam_id','steam_users_to_check',10);
	    $amountOfGames = $statsModel->getAmountOf('game_id','games');
	    $games = $DataSearchReadModel->getGames();

	    if(isset($_POST['game_title'])){	    	
	    	$_POST['clean_game_title'] = Sanitizer::sanitizeString(($_POST['game_title']));     	
	    	$searchResult = $DataSearchReadModel->searchDB('games', $_POST['clean_game_title']);
	    }

	    //$allUsers = $DataSearchReadModel->getAllUsers();
	    //$gamesModel = $this -> loadModel('gamesModel');
	    //var_dump($games);
	    $gameID = $games[0]['game_id'];

	    $gameInfo = $SteamAPISearchReadModel->getSteamGameData($gameID);

		$loader = new Twig_Loader_Filesystem('application/views/steamusers');
		$twig = new Twig_Environment($loader);
		$twig->addGlobal('URL', URL);
		require 'application/views/_templates/header.php';
		echo $twig->render('index.php',[
			'users' => $users,
			'amount_of_games'=> $amountOfGames,
			'games'=>$games]);
	    //require 'application/views/steamusers/index.php';
	    require 'application/views/_templates/debug.php';
	    require 'application/views/_templates/footer.php';
	}

	public function write()
	{
		echo " Kontroler ".get_class($this);
	}
}
?>