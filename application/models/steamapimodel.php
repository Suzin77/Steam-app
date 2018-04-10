<?php

/*IMPORTANT
*Cała klasa ma być rozbita na inne ponieważ jest aktualnie za duża.
*
*
*
*/
class SteamApiModel extends Model
{
	public function loadModel($model_name)
    {
        require 'application/models/' . strtolower($model_name) . '.php';
        // return new model (and pass the database connection to the model)
        return new $model_name($this->db);
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

	public function updateSteamUser($steamUsersData)
	{
		$sql="UPDATE users SET communityvisibilitystate = :communityvisibilitystate WHERE user_id = :steam_id";
		$query = $this->db->prepare($sql);
		$query->bindParam(':steam_id', $steamUsersData['response']['players'][0]['steamid'], PDO::PARAM_STR);
		$query->bindParam(':communityvisibilitystate', $steamUsersData['response']['players'][0]['communityvisibilitystate']);
		$query->execute();		
	}

	public function echoFromDeepModel()
	{
		$massage = $this->loadModel('deepModel');
		return $massage->echoFromDeep('Terror From The Deep');
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