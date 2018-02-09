<?php
include_once 'application/libs/model.php';

class SteamAPISearchReadModel extends Model
{
	//Model do laczenia i czytania danychc z api Steam

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