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
    <p>Liczba gier w bazie: <span>{{amount_of_games}}</span></p>
    <form class ="form-horizontal col-md-6 col-md-offset-3" action="{{URL}}Data/search/" method="POST">
        <label>Game title </label>
        <input type="text" name="game_title" value="" required />
        <input type="submit" name="submit_game_title" value="Submit" />
    </form>  
<!-- Tabela z wynikami wyszukiwania-->
    <div class = "row">
        <div class = "col-sm-6">
        <?php if(isset($searchResult)){ ?>
        <h3>Wynik wyszukiwania</h3>
            <table class = "">
                <thead >
                <tr>
                    <td>Game title</td>
                    <td>Steam ID</td>
                    <td>Image</td>
                </tr>
                </thead>
                <tbody>
                <?php     
                    foreach ($searchResult as $game) { ?>
                    <tr>
                        <td><?php if (isset($game['game_title'])) echo $game['game_title']; ?></td>
                        <td><?php if (isset($game['game_id'])) echo $game['game_id']; ?></td>
                        <td><?php if (isset($user['avatar'])) echo "<img src=\"".$user['avatar']."\" style=\"padding:1px\"/>" ?></td>


                        <td>
                            <?php if (isset($user->link)) { ?>
                                <a href="<?php echo $user->link; ?>"><?php echo $user->link; ?></a>
                            <?php } ?>
                        </td>
                        
                    </tr>
                <?php }
                 }
                 ?>
                <!-- end of foreach -->
                </tbody>
            </table>
        </div>  
<!-- Tabela z losowymi uzytkownikami-->
    <div class = "row">
        <div class = "col-sm-6">
    	<h3>List of random 20 users form database</h3>
            <table class = "table table-hover">
                <thead >
                <tr>
                    <td>User steam ID</td>
                    <td>Name</td>
                    <td>Image</td>
                    <td>Link</td>
                    <td>DELETE</td>
                </tr>
                </thead>
                <tbody>
                    {% for user in users %}
                    <tr>
                        <td> {{user.user_id}} </td>
                        <td> {{user.persona_name}} </td>
                        <td> <img src="{{user.avatar}}" style="padding:1px"/> </td>
                        <td> <a href="{{user.profileurl}}">link</a> </td>
                        <td> <a href="{{URL}}steamusers/deleteuser/{{user.user_id}}">x</a> </td>
                    </tr>   
                    {% endfor %} 
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
        <h3>List of 20 random Games from database</h3>
        <table class = "table table-hover">
                <thead >
                <tr>
                    <td>Id</td>
                    <td>Tytuł</td>
                    <td>Track</td>
                    <td>Cena</td>
                </tr>
                </thead>
                <tbody>
                    {% for game in games %}
                    <tr>
                        <td> {{game.game_name}} </td>
                        <td> {{game.game_id}} </td>
                        <td> <img src="{{game.avatar}}" style="padding:1px"/> </td>
                        <td> {{game.actual_price}} </td>
                        <td> <a href="{{URL}}steamusers/deleteuser/{{user.user_id}}">x</a> </td>
                    </tr>   
                    {% endfor %} 
                </tbody>
                <!-- end of foreach --> 
            </table>
        </div>
    </div>        
</div>
</div>	
