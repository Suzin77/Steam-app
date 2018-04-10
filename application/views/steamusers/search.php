<div class = "container">
    <h3>Wyszukaj użytkownika po SteamID</h3>
    <p>Przykładowe ID: 76561198014765204, 76561197970373921, 76561198002500907, 76561198008991804, 76561198018826719</p>
    <p>Kilka losowych przykladów do sprawdzenia :
    <?php foreach($exampleToCheck as $id){
        echo $id['steam_id']." // ";
    }
    ?>
    </p>    
    <form class ="form-horizontal col-md-6 col-md-offset-3" action="<?php echo URL; ?>steamAPI/search/" method="POST">
        <label>Steam ID </label>
        <input type="text" name="steam_user_id" value="" required />
        <input type="submit" name="submit_search_steam_user" value="Submit" />
    </form>    
    <div>
    	<h3>User Summary</h3>
    	<?php 

    	    if(isset($userInfo['response']['players'][0]['personaname'])){
    	 	    echo $userInfo['response']['players'][0]['personaname']."</br>";
    	 	
	    	 	if(isset($userGames['response'])){
	    	 		echo "Urzytkownik ma w kolekcji ".$userGames['response']['game_count']." gier</br>";
	    	 	}     	 	     	
    	 	    ?>
                <table>
                    <thead></thead>
                    <tbody>
                        <?php     
                    foreach ($userInfo['response']['players'] as $key => $value) { ?>
                    <tr>
                        <td><?php if (isset($userInfo['response']['players'][0]['personaname'])) echo $userInfo['response']['players'][0]['personaname']; ?></td>
                        <td><?php if (isset($userInfo['response']['players'][0]['steamid'])) echo $userInfo['response']['players'][0]['steamid']; ?></td>
                        <td><?php if (isset($userInfo['response']['players'][0]['avatar'])) echo "<img src=\"".$userInfo['response']['players'][0]['avatar']."\" style=\"padding:1px\"/>" ?></td>
                        <td>
                            <?php if (isset($userInfo['response']['players'][0]['timecreated'])) echo date('Y.m.d',$userInfo['response']['players'][0]['timecreated']); }?>
                              
                            
                        </td>
                        
                    </tr>
                <?php 
                 }
                 ?>
                <!-- end of foreach -->
                        
                    </tbody>
                </table>    
                <?php
	    	 	$table = "<table> <tbody>";
                var_dump($userInfo['response']['players']);
	    	 	foreach ($userInfo['response']['players'] as $key => $value){
	    	 		$table .="<tr>   	 		    						
	    						<td>".$userInfo['response']['players'][0]['personaname']."</td>
	    						<td>".$userInfo['response']['players'][0]['steamid']."</td>
	                            <td><img src=\"".$userInfo['response']['players'][0]['avatar']."\" style=\"padding:1px\"/></td>
	                            <td>".date('Y.m.d',$userInfo['response']['players'][0]['timecreated'])."</td>
	    					  </tr>";	 

	    	 	}
	    	 	$table .= "</table></tbody>";
	    	 	echo $table;	    	 	
	    	if (isset($userFriends)){
	    	
	    		//echo"</br>".$ftableBody;	    		
	    	}
		     

    	?>

    </div>	
</div>