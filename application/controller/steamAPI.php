<?php 

class SteamAPI extends Controller
{
    public function index()
    {
        /* Page: index.
        */        
        header('location: ' . URL . 'steamAPI/search');
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
        $exampleToCheck = $DataSearchReadModel->getRandomRows('steam_id','steam_users_to_check',10);	
        if(isset($_POST['submit_search_steam_user'])){			
        //sanitization of enterned data.
            $_POST['clean_steam_user_id'] = Sanitizer::sanitizeString(($_POST['steam_user_id']));
            $userInfo = $SteamAPISearchReadModel->searchSteamUser($_POST['clean_steam_user_id']);
            $userFriends = $SteamAPISearchReadModel->getSteamUserFriends($_POST['clean_steam_user_id']);
            $userGames = $SteamAPISearchReadModel->getSteamUserGames($_POST['clean_steam_user_id']);
                     
            if ($DataSearchReadModel->checkUser($_POST['clean_steam_user_id'])){
                $DataSearchWriteModel->addUser($userInfo);						
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
		header('location: '. URL . 'steamAPI/search');
	} 

    public function admin()
    {

    }

    public function updateUser()
    {
        $SteamAPISearchReadModel = $this -> loadModel('SteamAPISearchReadModel');
        $steamUsersModel = $this->loadModel('SteamUsersModel');
        $DataSearchWriteModel = $this->loadModel('DataSearchWriteModel');
        $allUsers = $steamUsersModel->getAllUsers();
        foreach($allUsers as $key => $value){	
            $userInfo = $SteamAPISearchReadModel->searchSteamUser($value['user_id']);
            $DataSearchWriteModel->updateSteamUser($userInfo);
        }
    header('location: '. URL . 'steamusers/index');	
	}
}

?>
