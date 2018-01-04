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

}
?>