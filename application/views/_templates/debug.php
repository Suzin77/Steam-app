<div class = "container">
<p>debuger</p>
<?php

if(isset($userInfo)){
	$user_model->recursiveResponse($userInfo);
	$userFriendsModel->recursiveResponse($userFriends);
	//$user_model->recursiveResponse($userAchivments);
	//$user_model->recursiveResponse($user_model->getGameInfo(2800));
	foreach($userInfo['response']['players'][0] as $key => $value){
		echo "klucz: <b>".$key."</b> wartosc <b>".$value." </b></br>";
	}	
}



?>

</div>