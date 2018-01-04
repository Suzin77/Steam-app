<div class = "container">
    <h3>Search Steam User</h3>
    <p>examples of ID: 76561198014765204, 76561197970373921, 76561198002500907, 76561198008991804, 76561198018826719</p>
    <form action="<?php echo URL; ?>steamusers/search" method="POST">
        <label>Steam ID </label>
        <input type="text" name="steam_user_id" value="" required />
        <input type="submit" name="submit_search_steam_user" value="Submit" />
    </form>
    <div>
    	
    	<?php if(isset($userInfo['response']['players'][0]['personaname'])) echo $userInfo['response']['players'][0]['personaname']; ?>

    </div>	
</div>