<div class = "container">
<p>debuger</p>


<?php

if(isset($userInfo)){
	foreach($userInfo['response']['players'][0] as $key => $value){
		echo "klucz: <b>".$key."</b> a wartosc <b>".$value." </b></br>";
	}	
}

?>

</div>