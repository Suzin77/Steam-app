<?php

class SteamUsersModel
{
	// every model need connection to database.

	function __construct($db){
		try {
			$this->db = $db;
		} catch (PDOException $e){
			exit('Nie udało się połączyć z bazą');
		}
	}

	public function getAllUsers()
	{
		$sql = "SELECT user_id,personal_name FROM users";
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

    public function getPlayerAchivments($steamUserId, $appId)//example of game 225160
    {   
    	$request = "http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=".$appId."&key=".STEAM_API_KEY."&steamid=".$steamUserId;	
		return $this -> getResponse($request);
    }

    public function getGameInfo($appId)
    {
    	return $this -> getResponse("http://store.steampowered.com/api/appdetails?appids=".$appId);
    }


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

    public function recursiveResponse($array, $level = 1)
    {
	    foreach($array as $key => $value){
	        //If $value is an array.	        
	        if(is_array($value)){
	        	echo str_repeat("+", $level)." [".$key."]: </br>";
	            //We need to loop through it.
	            $this -> recursiveResponse($value, $level + 1);
	        } else {
	            //It is not an array, so print it out.
	            echo str_repeat("+", $level)." [".$key . "]: [" . $value, ']<br>';
	        }
	    }
	}

}
?>