<?php 

class DataSearchWriteModel extends Model
{
	public function addUser($SteamUserData)
	{	
		$sql = "INSERT INTO users (user_id, persona_name, communityvisibilitystate,time_created,lastlogoff,profileurl, realname, loccountry_code, avatar, avatarmedium, avatarfull)
                VALUES (
                    :steam_id, 
                    :persona_name,
                    :communityvisibilitystate, 
                    :time_created, 
                    :lastlogoff, 
                    :profileurl, 
                    :realname, 
                    :loccountry_code, 
                    :avatar, 
                    :avatarmedium, 
                    :avatarfull)";
        $query = $this->db->prepare($sql);	
    	$query->bindParam(':steam_id', $SteamUserData['response']['players'][0]['steamid'], PDO::PARAM_STR);
    	$query->bindParam(':persona_name', $SteamUserData['response']['players'][0]['personaname']);
    	$query->bindParam(':communityvisibilitystate', $SteamUserData['response']['players'][0]['communityvisibilitystate']);
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

    public function addGame($gameData)
    {
        $sql = "INSERT INTO games () VALUES ()";
        $query = $this->db->prepare($sql);
    }

	public function removeId($SteamID, $tableName)
    {
    	$sql =  "DELETE FROM $tableName WHERE steam_id = :steam_id";
    	$query = $this->db->prepare($sql);
    	$query->bindParam(':steam_id', $SteamID );
    	$query->execute();
    	echo "</br> usunięcie wykonane";
    }

    public function addAnswer($data)
    {

        $sql = "INSERT INTO posts(answer) VALUES (:answer)";
        $query = $this->db->prepare($sql); 
        $query->bindParam(':answer', $data);
        $query->execute();
    }

    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id'=> $user_id));
    }

    public function addFriend($firendSteamId)
    {
        $sql = "INSERT INTO steam_users_to_check (steam_id) VALUES (:steam_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':steam_id'=>$firendSteamId));
    }    
}
