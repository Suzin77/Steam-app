<div class = "container">
	<h2>Co juz mamy</h2>

	<p>LIczba znalezionych graczy to: <span><?php echo $amountOfUsers?></span></p>
    <p>Liczba graczy do sprawdzenia to : <span><?php echo $amountToCheck?></span></p>
    <p>Przykłady do sprawdzenia: 
    <?php foreach($exampleToCheck as $id){
        echo $id['steam_id']." // ";
    }
    //var_dump($exampleToCheck);
    ?> 
    <span> 
	    <button type="button"><a href="<?php echo URL . 'admin/updateUser/' . $exampleToCheck[0]['steam_id']; ?>">aktualizuj</a>
	    </button>
    </span>	
       
    </p>
    <p><button type="button"><a href="<?php echo URL . 'admin/updateMany/40'; ?>">aktualizuj 10 na raz</a>
	    </button></p>
</div>
