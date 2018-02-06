<?php 

class SteamUsers extends Controller
{

    public function index()
    {
		/* Page: index.

		*/
		//echo "We are in index fumction in games controller ";

		//$steamUserModel = $this->loadModel('SteamUsersModel');
		$steamUserModel = $this->loadModel('SteamUsersModel');
	    $users = $steamUserModel->getUsers();	    
	    $steamapimodel = $this->loadModel('SteamApiModel');
	    $statsModel = $this->loadModel('StatsModel');
	    $amount_of_users = $statsModel->getAmountOf('user_id','users');
	    $amountToCheck = $statsModel->getAmountOf('steam_id','steam_users_to_check');
	    $exampleToCheck = $steamUserModel->getRandomRows('steam_id','steam_users_to_check',10);
	    $amoutOfGames = $statsModel->getAmountOf('game_id','games');
	    $games = $steamUserModel->getGames();
	    //$allUsers = $steamUserModel->getAllUsers();

	    //gams class test

	    $gamesModel = $this -> loadModel('gamesModel');
	    $gameInfo = $gamesModel->getSteamGameData(672970);

		require 'application/views/_templates/header.php';
	    require 'application/views/steamusers/index.php';
	    require 'application/views/_templates/debug.php';
	    require 'application/views/_templates/footer.php';
	}

	public function deleteUser($user_id)
	{
		if(isset($user_id)){
			$steamUserModel = $this->loadModel('SteamUsersModel');
			$deleteUser = $steamUserModel->deleteUser($user_id);
		}	
		header('location: ' . URL . 'steamusers/index');
	}

	public function search()
	{
		/* Page Search.
		If search form are submitted app start to connect with Steam API and return result as an array.
		*/
		if(isset($_POST['submit_search_steam_user'])){
			$user_model = $this->loadModel('SteamUsersModel');
			$steamApiModel = $this->loadModel('SteamApiModel');
			//sanitization of enterned data.
			$userID = $steamApiModel->sanitizeString(($_POST['steam_user_id']));
			$userInfo = $user_model->searchSteamUser($userID);
			$userFriends = $steamApiModel->getSteamUserFriends($userID);
			$userGames = $steamApiModel->getSteamUserGames($userID);
			if($userGames['response']){
				foreach($userGames['response']['games'] as $game =>$id){
					if($user_model->isGame($userGames['response']['games'][$game]['appid'])){
						$gameData = $user_model->getSteamGameData($userGames['response']['games'][$game]['appid']); 
						if($gameData[$userGames['response']['games'][$game]['appid']]['success'] == true){
							$user_model->writeGame($userGames['response']['games'][$game]['appid'],$gameData);
					    }
					}					
				}
				//$user_model->writeUserGamesRealtion($userID, $userGames['response']['games']);
			}

			/*if($user_model->checkUserGames($userID, 240)){
				echo "trzeba zapiac bo nie ma </br>";
			} else {
				echo "było";
			}*/
			//$userArray = $user_model->recursiveResponse($userinfo);
			//var_dump($user_model->checkUser(76561197997461962));
			if ($user_model->checkUser($_POST['steam_user_id'])){
				$steamApiModel->addUser($userInfo);						
			} else {
			}
			//$userAchivments = $user_model->getPlayerAchivments($_POST['steam_user_id'],39140);

			$ftable = $this->loadView('tablesviews');
			if(isset($userFriends['friendslist'])){
				$ftablePass = $ftable->createTableHeader($userFriends['friendslist']['friends'][0]);
				$userFriendsTable = $ftable->createTable($userFriends['friendslist']['friends'][0],$userFriends['friendslist']['friends']);
				$user_model->checkAllFriends($userFriends['friendslist']['friends']);
			}
			if(isset($userAchivments)){	
				$tableAchiv = $ftable->createTable($userAchivments['playerstats']['achievements'][0],$userAchivments['playerstats']['achievements']);
			}
			//check of friends
			//var_export($user_model->checkAllSteamUsersToChceck($user_model->getAllSteamUsersToCheck()));
			//var_export($user_model->getAllSteamUsersToCheck());		
			//$list = $user_model->recursiveResponse($userAchivments);

		}
			
		require 'application/views/_templates/header.php';
	    require 'application/views/steamusers/search.php';
	    require 'application/views/_templates/debug.php';
	    require 'application/views/_templates/footer.php';

	    //header('location: '.URL. 'steamusers/search/'.$_POST['submit_search_steam_user']);
	}  

	public function checkUser($userId)
	{
		if(isset($userId)){
			$userModel = $this -> loadModel('SteamUsersModel');
			$steamApiModel = $this->loadModel('SteamApiModel');
			$userInfo = $userModel->searchSteamUser($userId);
			if ($userModel->checkUser($userId)){
				$steamApiModel->addUser($userInfo);
				$userFriends = $steamApiModel->getSteamUserFriends($userId);
				$userModel->checkAllFriends($userFriends['friendslist']['friends']);			
				echo "zapisano";				
			} else {
				echo "taki juz był </br>";
			}
			$userModel->removeId($userId, "steam_users_to_check");
		}
		header('refresh:5; url='.URL.'steamusers/index');
		//header('location: '. URL . 'steamusers/index');
	} 

	public function admin()
	{

	}

	public function updateUser()
	{
		$steamUsersModel = $this->loadModel('SteamUsersModel');
		$steamApiModel = $this->loadModel('SteamApiModel');

		$allUsers = $steamUsersModel->getAllUsers();
		foreach($allUsers as $key => $value){
			
			$userInfo = $steamUsersModel->searchSteamUser($value['user_id']);
			$steamApiModel->updateSteamUser($userInfo);
		}
	header('location: '. URL . 'steamusers/index');	
	}
}

?>
