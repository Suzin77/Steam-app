<?php

class SteamAPISearchReadModel extends Model
{
	//Model do laczenia i czytania danychc z api Steam aaaaaaa

	public function searchSteamUser($steamUserId)
	{
		$request = $this -> createSteamUserInfoRequest($steamUserId);
		return  $this -> getResponse($request);
	}

	public function getSteamGameData($gameID)
    {
    	$url = "http://store.steampowered.com/api/appdetails?appids=".$gameID;
    	return array("url" => $url , "response"=> $this->getResponse($url));
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

    public function getSteamUserGames($steamUserId)
	{
	    $steamUserGamesRequest = "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=".STEAM_API_KEY."&format=json&input_json={\"steamid\":".$steamUserId.",\"include_appinfo\":true,\"include_played_free_games\":false}";

	    return $this -> getResponse($steamUserGamesRequest);
	}

	public function getSteamUserFriends($steamUserId)
	{		
		$steamUserFriendsRequest = "http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=".STEAM_API_KEY."&steamid=".$steamUserId."&relationship=friend";
		return $this->getResponse($steamUserFriendsRequest);
	}

	
}
?>