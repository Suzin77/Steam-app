<?php

class SteamUsersModel extends Model
{

    /*

    * docelowo clasa do usunięcia. moedoty są wg funkcji przenoszone do glownych modeli:
    - steamAPISearchModel, DataSearchReadModel, DataSearchWriteModel 
    ** przeniesiona do datasearchreadmodel
	public function getUsers()
	{
		$sql = "SELECT user_id,persona_name,avatar FROM users ORDER BY rand() LIMIT 20";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
    
    **metoda jest w DataReadModel
    public function getGames()
	{
		$sql = "SELECT game_id,game_name FROM games ORDER BY rand() LIMIT 20";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
  
	public function deleteUser($user_id)
	{
		$sql = "DELETE FROM users WHERE user_id = :user_id";
		$query = $this->db->prepare($sql);
		$query->execute(array(':user_id'=> $user_id));

	}

	
    metoda/y juz jest w SteamAPISearchReadModel
    public function searchSteamUser($steamUserId)
	{
		$request = $this -> createSteamUserInfoRequest($steamUserId);
		return  $this -> getResponse($request);
	}
    

	public function createSteamUserInfoRequest($steamUserId)
    {   	
	    $steamUserInfoRequest = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".STEAM_API_KEY."&steamids=".$steamUserId."&format=json";   		
	    return $steamUserInfoRequest;
    }
    */
    /*
    public function getPlayerAchivments($steamUserId, $appId)//example of game 225160
    {   
    	$request = "http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=".$appId."&key=".STEAM_API_KEY."&steamid=".$steamUserId;	
		return $this -> getResponse($request);
    }

    */
    /* dodalem do datasearchwritemodel
    public function addFriend($firendSteamId)
    {
    	$sql = "INSERT INTO steam_users_to_check (steam_id) VALUES (:steam_id)";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':steam_id'=>$firendSteamId));
    }
    */

    /*
    public function checkUser($userId)
    {
    	$sql = "SELECT user_id FROM users WHERE user_id = :steam_id";
    	$query = $this->db->prepare($sql);    	
    	$query->bindParam(':steam_id', $userId, PDO::PARAM_STR);
    	$query->execute();
    	if(($query->rowCount()) == 0){
    	    return true;  	    	
    	}
    	return false;
    }
    */
    /*
    public function checkFriend($firendSteamId)
    {
    	$sql = "SELECT steam_id FROM steam_users_to_check WHERE steam_id = :steam_id";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':steam_id'=>$firendSteamId));
    	if(($query->rowCount())== 0 ){
    		return true;
    	}
    	return false;
    }
    */

    public function checkUserGamesApiResponse($userID, $gameID)
    {
    	$sql = "SELECT user_id FROM user_games WHERE user_id = :user_id AND game_id = :game_id";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':user_id'=>$userID, ':game_id'=>$gameID));
    	if(($query->rowCount())==0){
    		return true;
    	}
    	return false;
    }

    public function writeUserGames($userID, $gameID)
    {
    	$sql = "INSERT INTO user_games (user_id, game_id)
                VALUES (:user_id, :game_id)";
        //var_dump($SteamUserData['response']['players'][0]['loccountrycode']);
        $query = $this->db->prepare($sql);	
    	$query->bindParam(':user_id', $userID);
    	$query->bindParam(':game_id', $gameID);	
    	$query->execute();
    }

    public function writeUserGamesRealtion($userID, $gameData)
    {
    	foreach ($gameData as $game => $id){
    		if($this->checkUserGamesApiResponse($userID, $gameData[$game]['appid'])){
    			$this->writeUserGames($userID, $gameData[$game]['appid']);
    			//echo "zapisalem";
    		}
    		//echo $userID.' '.$gameData[$game]['appid'].'/';
    		//writeUserGames($userID,$gameData[$key]['appid']);
    	}
    }
    /* jest w steamAPISearchReadModel
    public function getSteamGameData($gameID)
    {
    	$url = "http://store.steampowered.com/api/appdetails?appids=".$gameID;
    	return $this->getResponse($url);
    }
    

    public function isGame($gameID)
    {
		$sql = "SELECT game_id FROM games WHERE game_id = :game_id";
		$query = $this->db->prepare($sql);
		$query->execute(array(':game_id'=>$gameID));
		if(($query->rowCount())==0){
			return true;
		}
		return false;
    }
    */

    
    public function writeGame($gameID, $gameData)
    {
    	$sql = "INSERT INTO games (game_id, game_name, actual_price)
    			VALUES (:game_id, :game_name, :actual_price)";
    	$query = $this->db->prepare($sql);

    	$query->bindParam(':game_id', $gameID);
    	$query->bindParam(':game_name', $gameData[$gameID]['data']['name']);
    	$query->bindParam(':actual_price', $gameData[$gameID]['data']['price_overview']['final']);
    	//var_dump($gameData[$gameID]['data']['steam_appid']);
    	//echo"Game ID z write game to ".$gameID."</br>";
    	//var_dump($gameData[$gameID]['data']['name']);
    	//echo"</br>";
    	//var_dump($gameData[$gameID]['data']['price_overview']['final']);
    	//echo"</br>";
    	$query->execute();
    }
    /*
    public function removeId($SteamId, $tableName)
    {
    	$sql =  "DELETE FROM $tableName WHERE steam_id = :steam_id";
    	$query = $this->db->prepare($sql);
    	$query->bindParam(':steam_id', $SteamId );
    	$query->execute();
    	echo "</br> usunięcie wykonane";
    }
    */
    /*
    public function checkAllFriends($data)
    {			
    	foreach ($data as $key => $value){
    		if (($this->checkFriend($data[$key]['steamid']))){
    			$this->addFriend($data[$key]['steamid']);
    		}
    	}
    }
    */
    public function getAllSteamUsersToCheck()
    {
    	$sql = "SELECT steam_id FROM steam_users_to_check";
    	$query = $this->db->prepare($sql);
    	$query->execute();
    	return $query->fetchAll();
    }

    public function checkAllSteamUsersToChceck($data)
    {		
    	foreach($data as $key => $value ){
    		echo "data from: ";
    		var_dump($data[$key]['steam_id']);
    		echo "</br>";
    		if (!($this->checkFriend($data[$key]['steam_id']))){
    			$this->addFriend($data[$key]['steam_id']);
    		}
    	}
    }

/* jest w model.php
    public function getResponse($url)
    {
    	$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $output = curl_exec($ch);
	    if ($output === false){ 
	       echo "Crul error: ".crul_error($ch);
	    } else {	
	       $data = json_decode($output,true);
	       curl_close ($ch);      
	       return $data;
	    }
    }

*/
    public function recursiveResponse($array, $level = 1)
    {
	    foreach($array as $key => $value){
	        //If $value is an array.	        
	        if(is_array($value)){
	        	echo str_repeat("&nbsp", $level)." [".$key."]: </br>";
	            //We need to loop through it.
	            $this -> recursiveResponse($value, $level + 1);
	        } else {
	            //It is not an array, so print it out.
	            echo str_repeat("&nbsp ", $level)." [".$key . "]: " . $value, '<br>';
	        }
	    }
	}

}
?>