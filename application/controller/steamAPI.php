<?php 

class SteamAPI extends Controller
{
    public function index()
    {
        /* Page: index.
        */
        //$steamUserModel = $this->loadModel('SteamUsersModel');
        echo "jestesmy w klasie ".get_class($this);
        //header('location: ' . URL . 'steamAPI/search');
    }

    public function deleteUser($user_id)
    {
        if(isset($user_id)){
            $DataSearchWriteModel = $this->loadModel('DataSearchWriteModel');
            $DataSearchWriteModel->deleteUser($user_id);
        }	
        header('location: ' . URL . 'steamAPI/search');
    }

    public function search()
    {
        /* Page Search.
        If search form are submitted app start to connect with Steam API and return result as an array.
        */

        //Load necessary models.
        $SteamAPISearchReadModel = $this -> loadModel('SteamAPISearchReadModel');
        $userModel = $this->loadModel('SteamUsersModel');
        $DataSearchReadModel = $this ->loadModel('DataSearchReadModel');
        $DataSearchWriteModel = $this->loadModel('DataSearchWriteModel');
        $steamApiModel = $this->loadModel('SteamApiModel');
        $exampleToCheck = $DataSearchReadModel->getRandomRows('steam_id','steam_users_to_check',10);	
        if(isset($_POST['submit_search_steam_user'])){			
        //sanitization of enterned data.
            $_POST['steam_user_id'] = $steamApiModel->sanitizeString(($_POST['steam_user_id']));
            $userInfo = $SteamAPISearchReadModel->searchSteamUser($_POST['steam_user_id']);
            $userFriends = $SteamAPISearchReadModel->getSteamUserFriends($_POST['steam_user_id']);
            $userGames = $SteamAPISearchReadModel->getSteamUserGames($_POST['steam_user_id']);
            /*
            if($userGames['response']){
                foreach($userGames['response']['games'] as $game =>$id){
                    if($DataSearchReadModel->isGame($userGames['response']['games'][$game]['appid'])){
                    $gameData = $userModel->getSteamGameData($userGames['response']['games'][$game]['appid']); 
                        if($gameData[$userGames['response']['games'][$game]['appid']]['success'] == true){
                            $DataSearchWriteModel->writeGame($userGames['response']['games'][$game]['appid'],$gameData);
                        }
                    }					
                }
                //$user_model->writeUserGamesRealtion($userID, $userGames['response']['games']);
            }
            */
            /*if($user_model->checkUserGames($userID, 240)){
                echo "trzeba zapiac bo nie ma </br>";
            } else {
                echo "było";
            }*/            
            //$userArray = $user_model->recursiveResponse($userinfo);
            //var_dump($user_model->checkUser(76561197997461962));
            if ($DataSearchReadModel->checkUser($_POST['steam_user_id'])){
                $DataSearchWriteModel->addUser($userInfo);						
            } else {
            }

            $ftable = $this->loadView('tablesviews');
            if(isset($userFriends['friendslist'])){
                $ftablePass = $ftable->createTableHeader($userFriends['friendslist']['friends'][0]);
                $userFriendsTable = $ftable->createTable($userFriends['friendslist']['friends'][0],$userFriends['friendslist']['friends']);
                $DataSearchReadModel->checkAllFriends($userFriends['friendslist']['friends'], $DataSearchWriteModel);
            }
            if(isset($userAchivments)){	
            	$tableAchiv = $ftable->createTable($userAchivments['playerstats']['achievements'][0],$userAchivments['playerstats']['achievements']);
            }
            //check of friends
            //var_export($user_model->checkAllSteamUsersToChceck($user_model->getAllSteamUsersToCheck()));
            //var_export($user_model->getAllSteamUsersToCheck());		
            //$list = $SteamAPISearchReadModel->recursiveResponse($userAchivments);
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
            $DataSearchReadModel = $this ->loadModel('DataSearchReadModel');
			$SteamAPISearchReadModel = $this -> loadModel('SteamAPISearchReadModel');
			$userModel = $this -> loadModel('SteamUsersModel');
			$steamApiModel = $this->loadModel('SteamApiModel');
			$DataSearchWriteModel = $this ->loadModel('DataSearchWriteModel');
			$userInfo = $SteamAPISearchReadModel->searchSteamUser($userId);
			if ($DataSearchReadModel->checkUser($userId)){
				$DataSearchWriteModel->addUser($userInfo);
				$userFriends = $SteamAPISearchReadModel->getSteamUserFriends($userId);
				$DataSearchReadModel->checkAllFriends($userFriends['friendslist']['friends'],$DataSearchWriteModel);			
				echo "zapisano";				
			} else {
				echo "taki juz był </br>";
			}
			$DataSearchWriteModel->removeId($userId, "steam_users_to_check");
		}
		//header('refresh:5; url='.URL.'steamAPI/search');
		header('location: '. URL . 'steamAPI/search');
	} 

	public function admin()
    {

    }

    public function updateUser()
    {
        $SteamAPISearchReadModel = $this -> loadModel('SteamAPISearchReadModel');
        $steamUsersModel = $this->loadModel('SteamUsersModel');
        $steamApiModel = $this->loadModel('SteamApiModel');
        $allUsers = $steamUsersModel->getAllUsers();
        foreach($allUsers as $key => $value){	
            $userInfo = $SteamAPISearchReadModel->searchSteamUser($value['user_id']);
            $steamApiModel->updateSteamUser($userInfo);
        }
    header('location: '. URL . 'steamusers/index');	
	}
}

?>
