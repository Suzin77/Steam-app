<div class = "container debug">    
<span><p>debuger</p><button id="show-debug">Rozwiń</button></span>

<div class="debug-content" style="display:none">
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
    	foreach($userInfo['response']['players'][0] as $key => $value){
    		echo "klucz: <b>".$key."</b> wartosc <b>".$value." </b></br>";
    	}	
    }
    //var_dump($gameInfo);


    if(isset($gameInfo)){

        $it = new RecursiveArrayIterator($gameInfo);
        $tit = new RecursiveTreeIterator($it);

        foreach( $tit as $key => $value ){
            echo $value ."</br>". PHP_EOL;
        }

        var_dump($gameInfo["url"]);
        echo "<pre>".var_export($gameInfo,true)."</pre>";
        if(isset($gameInfo[$gameID]['data']['header_image'])){
            $icon = $gameInfo[$gameID]['data']['header_image'];
    	    foreach($gameInfo[$gameID]['data'] as $key => $value){
    	        echo "klucz: <b>".$key."</b> wartosc <b>".$value." </b></br>";
    	    }	
    	//var_dump($gameInfo);
        }
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
</div>
<script>
    $("#show-debug").on("click",function(){
        $(".debug-content").toggle("slow");
    });
</script>