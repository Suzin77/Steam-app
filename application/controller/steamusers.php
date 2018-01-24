<?php 

class SteamUsers extends Controller
{

    public function index()
    {
		/* Page: index.

		*/
		echo "We are in index fumction in games controller ";

		$games_model = $this->loadModel('SteamUsersModel');
	    $users = $games_model->getAllUsers();

	    $stats_model = $this->loadModel('StatsModel');
	    $amount_of_users = $stats_model->getAmountOfUsers();

		require 'application/views/_templates/header.php';
	    require 'application/views/steamusers/index.php';
	    require 'application/views/_templates/footer.php';
	}

	public function deleteUser($user_id)
	{
		if(isset($user_id)){
			$games_model = $this->loadModel('SteamUsersModel');
			$deleteUser = $games_model->deleteUser($user_id);
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
			$userFriendsModel = $this->loadModel('SteamApiModel');
			//sanitization of enterned data.
			$userFriendsModel->sanitizeString(($_POST['submit_search_steam_user']));

			$userInfo = $user_model->searchSteamUser($_POST['steam_user_id']);
			$userFriends = $userFriendsModel->getSteamUserFriends($_POST['steam_user_id']);
			//$userArray = $user_model->recursiveResponse($userinfo);
			//var_dump($user_model->checkUser(76561197997461962));
			if ($user_model->checkUser($_POST['steam_user_id'])){
				$userFriendsModel->addUser($userInfo);
				echo "zapisano";				
			} else {
				echo "taki juz był </br>";
			}
			$userAchivments = $user_model->getPlayerAchivments($_POST['steam_user_id'],39140);

			$ftable = $this->loadView('tablesviews');
			$ftablePass = $ftable->createTableHeader($userFriends['friendslist']['friends'][0]);
			$userFriendsTable = $ftable->createTable($userFriends['friendslist']['friends'][0],$userFriends['friendslist']['friends']);
			if(isset($userAchivments)){	
			$tableAchiv = $ftable->createTable($userAchivments['playerstats']['achievements'][0],$userAchivments['playerstats']['achievements']);

			//check of friends
			//var_dump($user_model->checkFriend('76561197970373921'));
			//$user_model->checkAllFriends($userFriends['friendslist']['friends']);
			//var_export($user_model->checkAllSteamUsersToChceck($user_model->getAllSteamUsersToCheck()));
			//var_export($user_model->getAllSteamUsersToCheck());


			}

			//$list = $user_model->recursiveResponse($userAchivments);
		}
			
		require 'application/views/_templates/header.php';
	    require 'application/views/steamusers/search.php';
	    require 'application/views/_templates/debug.php';
	    require 'application/views/_templates/footer.php';
	}   
}

?>
