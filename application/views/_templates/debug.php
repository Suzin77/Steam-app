<div class = "container">
<p>debuger</p>
<?php

if(isset($countryStatsModel)){
	$result = array();
	echo (100- $ratio)."</br>";
	echo "W odpowiedzi ".$numberOfRows." użytkowników na ".$amountOfUsers." ma dostępną nazwę karaju</br>";
	echo "Pozostale ".($amountOfUsers-$numberOfRows)." (co stanowi ".(100 - $ratio)."% całości )nie ma takich danych ";
	$temp1=array_values($allCountries);
}

if(isset($userGames)){
	if($userGames['response'] != 0){
		var_dump($userGames['response']['game_count']);
		//var_dump($userGames);
	}	
}

if(isset($userInfo)){
	//var_dump($ftableBody);
	//echo"</br>".$userFriendsTable;
	//echo"</br>".$tableAchiv;
	//var_dump($userAchivments);
	//var_dump($userFriends);
	//$user_model->recursiveResponse($userInfo);
	//$userFriendsModel->recursiveResponse($userFriends);

	//$user_model->recursiveResponse($userAchivments);
	//$user_model->recursiveResponse($user_model->getGameInfo(2800));
	foreach($userInfo['response']['players'][0] as $key => $value){
		echo "klucz: <b>".$key."</b> wartosc <b>".$value." </b></br>";
	}	
}
//var_dump($gameInfo);


if(isset($gameInfo)){

   var_dump($gameInfo["url"]);
   echo "<pre>".var_export($gameInfo,true)."</pre>";
	$icon = $gameInfo[$gameID]['data']['header_image'];
	foreach($gameInfo[$gameID]['data'] as $key => $value){
		echo "klucz: <b>".$key."</b> wartosc <b>".$value." </b></br>";
	}	
	//var_dump($gameInfo);

?>
<img src="<?php echo $icon ?>" style="padding:1px"/>
<?php } ?>
<button type="button" class = "btn btn-default""><a href= "<?php echo URL . 'steamusers/updateUser'; ?>">Update Me!</a></button>
 <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>relation</td>
                
         		<td>trzecia</td>>
                <td>chceck</td>
            </tr>
            </thead>
            <tbody>
            <?php 
            if(isset($userFriends['friendslist']['friends'])){
            	foreach ($userFriends['friendslist']['friends'] as $friend) { ?>
                <tr>
                    <td><?php if (isset($friend['steamid'])) echo $friend['steamid']; ?></td>
                    <td><?php if (isset($friend['friend_since'])) echo $friend['friend_since']; ?></td>
                    <td><?php if (isset($friend['relation'])) echo $friend['relation']; ?></td>                 
                    <td><a href="<?php echo URL . 'steamAPI/checkUser/' . $friend['steamid']; ?>">CHECK</a></td>
                </tr>
            <?php }} ?>
            <!-- end of foreach -->
            </tbody>
</table>

 <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>KRAJ</td>
                <td>ILOSC</td>
                
         		<td>trzecia</td>>
                <td>chceck</td>
            </tr>
            </thead>

 <tbody>
            <?php 
            if(isset($allCountries)){
            	foreach ($allCountries as $country => $value) { ?>
                <tr>
                    <td><?php if (isset($allCountries)) echo $country; ?></td>
                    <td><?php if (isset($allCountries)) echo $allCountries[$country]; ?></td>
                    <td><?php if (isset($allCountries)) echo $countryStatsModel-> ratioPerSent($amountOfUsers,$allCountries[$country]); ?></td>                
                </tr>
            <?php }} ?>
            <!-- end of foreach -->
            </tbody>
</table>

</div>