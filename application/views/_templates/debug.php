<div class = "container">
<p>debuger</p>


<?php

$user_model->recursiveResponse($userInfo);
$user_model->recursiveResponse($user_model->getGameInfo(2800));

var_export($userInfo);

if(isset($userInfo)){
	foreach($userInfo['response']['players'][0] as $key => $value){
		echo "klucz: <b>".$key."</b> a wartosc <b>".$value." </b></br>";
	}	
}



?>

</div>