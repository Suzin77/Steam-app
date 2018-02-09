<?php
class Data extends Controller
{
	public function search()
	{
		$steamUserModel = $this->loadModel('SteamUsersModel');
		$DataSearchReadModel = $this ->loadModel('DataSearchReadModel');
	    $users = $steamUserModel->getUsers();	    
	    $steamapimodel = $this->loadModel('SteamApiModel');
	    $statsModel = $this->loadModel('StatsModel');
	    $amount_of_users = $statsModel->getAmountOf('user_id','users');
	    $amountToCheck = $statsModel->getAmountOf('steam_id','steam_users_to_check');
	    $exampleToCheck = $DataSearchReadModel->getRandomRows('steam_id','steam_users_to_check',10);
	    $amoutOfGames = $statsModel->getAmountOf('game_id','games');
	    $games = $steamUserModel->getGames();
	    //$allUsers = $DataSearchReadModel->getAllUsers();

	    //gams class test

	    //$gamesModel = $this -> loadModel('gamesModel');
	    //$gameInfo = $gamesModel->getSteamGameData(672970);

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