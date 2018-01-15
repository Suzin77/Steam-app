<div class = "container">
    <h3>Search Steam User</h3>
    <p>examples of ID: 76561198014765204, 76561197970373921, 76561198002500907, 76561198008991804, 76561198018826719</p>
    <form class ="form-horizontal col-md-6 col-md-offset-3" action="<?php echo URL; ?>steamusers/search" method="POST">
        <label>Steam ID </label>
        <input type="text" name="steam_user_id" value="" required />
        <input type="submit" name="submit_search_steam_user" value="Submit" />
    </form>
    <div>
    	<h3>User Summary</h3>
    	<?php 

    	    if(isset($userInfo['response']['players'][0]['personaname'])){
    	 	    echo $userInfo['response']['players'][0]['personaname'];
    	 	    echo "</br>";
    	 	    echo "<table>".$ftablePass."</table></br>";
    	 	    //$user_model->recursiveResponse($userAchivments);
    	 	
    	 	    
	    	 	$table = "<table> <tbody>";
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
	    	 }

	    	if (isset($userFriends)){
	    		//echo"</br>".$ftableBody;	    		
	    	}  	     
    	?>

    </div>	
</div>