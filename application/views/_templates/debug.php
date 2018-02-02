<div class = "container">
<p>debuger</p>
<?php

if(isset($userGames)){
	if($userGames['response'] != 0){
		var_dump($userGames['response']['game_count']);
		//var_dump($userGames);
	}	
}

if (isset($games)){ 
	//var_dump($games);
	//var_dump($gameInfo);
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

?>
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
                    <td><a href="<?php echo URL . 'steamusers/checkUser/' . $friend['steamid']; ?>">CHECK</a></td>
                </tr>
            <?php }} ?>
            <!-- end of foreach -->
            </tbody>

</div>