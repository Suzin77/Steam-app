<?php
class Data extends Controller
{
	public function search()
	{
		$SteamAPISearchReadModel = $this->loadModel('SteamAPISearchReadModel');
		$steamUserModel = $this->loadModel('SteamUsersModel');
		$DataSearchReadModel = $this ->loadModel('DataSearchReadModel');
	    $users = $DataSearchReadModel->getUsers();	    
	    $steamapimodel = $this->loadModel('SteamApiModel');
	    $statsModel = $this->loadModel('StatsModel');
	    $amount_of_users = $statsModel->getAmountOf('user_id','users');
	    $amountToCheck = $statsModel->getAmountOf('steam_id','steam_users_to_check');
	    $exampleToCheck = $DataSearchReadModel->getRandomRows('steam_id','steam_users_to_check',10);
	    $amoutOfGames = $statsModel->getAmountOf('game_id','games');
	    $games = $DataSearchReadModel->getGames();

	    //$allUsers = $DataSearchReadModel->getAllUsers();
	    //$gamesModel = $this -> loadModel('gamesModel');
	    //var_dump($games);
	    $gameID = $games[0]['game_id'];

	    $gameInfo = $SteamAPISearchReadModel->getSteamGameData($gameID);

		require 'application/views/_templates/header.php';
	    require 'application/views/steamusers/index.php';
	    require 'application/views/_templates/debug.php';
	    require 'application/views/_templates/footer.php';
	}

	public function write()
	{
		echo " Kontroler ".get_class($this);
	}
}
?>