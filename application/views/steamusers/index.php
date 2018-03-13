<div class = "container">
	<h2>Statystyki posiadanych danych</h2>

	<p>LIczba znalezionych graczy to: <span><?php echo $amount_of_users?></span></p>
    <p>Liczba graczy do sprawdzenia to : <span><?php echo $amountToCheck?></span></p>
    <p>Przykłady do sprawdzenia: 
    <?php foreach($exampleToCheck as $id){
        echo $id['steam_id']." // ";
    }
    ?>       
    </p>
    <p>Liczba gier w bazie: <span><?php echo $amoutOfGames ?></span></p>
    <form class ="form-horizontal col-md-6 col-md-offset-3" action="<?php echo URL; ?>Data/search/" method="POST">
        <label>Game title </label>
        <input type="text" name="game_title" value="" required />
        <input type="submit" name="submit_game_title" value="Submit" />
    </form>  
<!-- Tabela z wynikami wyszukiwania-->
    <div class = "row">
        <div class = "col-sm-6">
        <h3>Wynik wyszukiwania</h3>
            <table class = "">
                <thead style="background-color: #ddd; font-weight: bold;">
                <tr>
                    <td>Game title</td>
                    <td>Steam ID</td>
                    <td>Image</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($searchResult as $game) { ?>
                    <tr>
                        <td><?php if (isset($game['game_title'])) echo $game['game_title']; ?></td>
                        <td><?php if (isset($game['game_id'])) echo $game['game_id']; ?></td>
                        <td><?php if (isset($user['avatar'])) echo "<img src=\"".$user['avatar']."\" style=\"padding:1px\"/>" ?></td>


                        <td>
                            <?php if (isset($user->link)) { ?>
                                <a href="<?php echo $user->link; ?>"><?php echo $user->link; ?></a>
                            <?php } ?>
                        </td>
                        <td><a href="<?php echo URL . 'steamusers/deleteuser/' . $user['user_id']; ?>">x</a></td>
                    </tr>
                <?php } ?>
                <!-- end of foreach -->
                </tbody>
            </table>
        </div>  
<!-- Tabela z losowymi uzytkownikami-->
    <div class = "row">
        <div class = "col-sm-6">
    	<h3>List of users (data from first model)</h3>
            <table class = "">
                <thead style="background-color: #ddd; font-weight: bold;">
                <tr>
                    <td>User steam ID</td>
                    <td>Name</td>
                    <td>Image</td>
                    <td>Link</td>
                    <td>DELETE</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php if (isset($user['user_id'])) echo $user['user_id']; ?></td>
                        <td><?php if (isset($user['persona_name'])) echo $user['persona_name']; ?></td>
                        <td><?php if (isset($user['avatar'])) echo "<img src=\"".$user['avatar']."\" style=\"padding:1px\"/>" ?></td>


                        <td>
                            <?php if (isset($user->link)) { ?>
                                <a href="<?php echo $user->link; ?>"><?php echo $user->link; ?></a>
                            <?php } ?>
                        </td>
                        <td><a href="<?php echo URL . 'steamusers/deleteuser/' . $user['user_id']; ?>">x</a></td>
                    </tr>
                <?php } ?>
                <!-- end of foreach -->
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
        <h3>List of Games </h3>
        <table class = "">
                <thead style="background-color: #ddd; font-weight: bold;">
                <tr>
                    <td>Id</td>
                    <td>Tytuł</td>
                    <td>Track</td>
                    <td>Cena</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($games as $game) { ?>
                    <tr>
                        <td><?php if (isset($game['game_id'])) echo $game['game_id']; ?></td>
                        <td><?php if (isset($game['game_name'])) echo $game['game_name']; ?></td>
                        <td><?php if (isset($game['avatar'])) echo "<img src=\"".$game['avatar']."\" style=\"padding:1px\"/>" ?></td>
                         <td><?php if (isset($game['actual_price'])) echo $game['actual_price']?></td>


                        <td>
                            <?php if (isset($user->link)) { ?>
                                <a href="<?php echo $user->link; ?>"><?php echo $user->link; ?></a>
                            <?php } ?>
                        </td>
                        
                    </tr>
                <?php } ?>
                <!-- end of foreach -->
                </tbody>
            </table>
        </div>
    </div>        
</div>	
