<?php 

class DataSearchReadModel extends Model
{
	public function getRandomRows($column,$tableName,$limit=1)
	{
		$sql = "SELECT $column FROM $tableName ORDER BY rand() LIMIT $limit";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function getAllUsers()
	{
		$sql = "SELECT user_id,persona_name,avatar FROM users WHERE communityvisibilitystate = 0 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function getUsers()
	{
		$sql = "SELECT user_id,persona_name,avatar FROM users ORDER BY rand() LIMIT 20";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function getGames()
	{
		$sql = "SELECT game_id,game_name,actual_price FROM games ORDER BY rand() LIMIT 20";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function searchDB($table, $phrase)
	{
		$sql = "SELECT game_name AS 'game_title', game_id FROM games WHERE game_name LIKE '%".$phrase."%'";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
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

    public function checkAllFriends($data, $model)
    {			
    	foreach ($data as $key => $value){
    		if (($this->checkFriend($data[$key]['steamid']))){
    			
    			$model->addFriend($data[$key]['steamid']);
    			//$this->addFriend($data[$key]['steamid']);
    		}
    	}
    }


	
}
?>