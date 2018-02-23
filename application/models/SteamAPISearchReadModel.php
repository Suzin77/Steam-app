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

	public function getSteamGameData($gameID)
    {
    	$url = "http://store.steampowered.com/api/appdetails?appids=".$gameID;
    	return $this->getResponse($url);
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

	
}
?>