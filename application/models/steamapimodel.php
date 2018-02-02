<?php

class SteamApiModel
{
	function __construct($db){
		try {
			$this->db = $db;
		} catch (PDOException $e){
			exit('Nie udało się połączyć z bazą');
		}
	}
	

	public function getSteamUserFriends($steamUserId)
	{		
		$steamUserFriendsRequest = "http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=".STEAM_API_KEY."&steamid=".$steamUserId."&relationship=friend";
		return $this->getResponse($steamUserFriendsRequest);
	}

	public function sanitizeString($string)
	{
		$string = strip_tags($string);
		$string = htmlentities($string);
		return stripcslashes($string);
	}

	public function getGameInfo($gameID)
	{
		$request = "http://store.steampowered.com/api/appdetails?appids=".$gameID;
		return $this->getResponse($request); 
	}

	public function getSteamUserGames($steamUserId)
	{
		$steamUserGamesRequest = "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=".STEAM_API_KEY."&format=json&input_json={\"steamid\":".$steamUserId.",\"include_appinfo\":true,\"include_played_free_games\":false}";
		return $this -> getResponse($steamUserGamesRequest);
	}

	public function addUser($SteamUserData)
	{	
		$sql = "INSERT INTO users (user_id, persona_name, time_created,lastlogoff,profileurl, realname, loccountry_code, avatar, avatarmedium, avatarfull)
                VALUES (:steam_id, :persona_name, :time_created, :lastlogoff, :profileurl, :realname, :loccountry_code, :avatar, :avatarmedium, :avatarfull)";
        //var_dump($SteamUserData['response']['players'][0]['loccountrycode']);
        $query = $this->db->prepare($sql);	
    	$query->bindParam(':steam_id', $SteamUserData['response']['players'][0]['steamid'], PDO::PARAM_STR);
    	$query->bindParam(':persona_name', $SteamUserData['response']['players'][0]['personaname']);
    	$query->bindParam(':time_created', $SteamUserData['response']['players'][0]['timecreated']);
    	$query->bindParam(':lastlogoff', $SteamUserData['response']['players'][0]['lastlogoff']);
    	$query->bindParam(':profileurl', $SteamUserData['response']['players'][0]['profileurl']);
    	$query->bindParam(':realname', $SteamUserData['response']['players'][0]['realname']);
    	$query->bindParam(':loccountry_code', $SteamUserData['response']['players'][0]['loccountrycode']);
    	$query->bindParam(':avatar', $SteamUserData['response']['players'][0]['avatar']);
    	$query->bindParam(':avatarmedium', $SteamUserData['response']['players'][0]['avatarmedium']);
    	$query->bindParam(':avatarfull', $SteamUserData['response']['players'][0]['avatarfull']);
    	
    	$query->execute();

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