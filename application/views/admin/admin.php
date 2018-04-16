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
    <p><button type="button"><a href="<?php echo URL . 'admin/updateMany/40'; ?>">aktualizuj 40 na raz</a>
	    </button></p>

    <div>
        <form id="updateManyForm">
            <input type="radio" name="updateMany" value="10" checked>10
            <input type="radio" name="updateMany" value="20">20
            <input type="radio" name="updateMany" value="40">40
            <input type="radio" name="updateMany" value="100">100
            <input type="radio" name="updateMany" value="200">200<br>
            <p><button type="button" id="updateMany"><a id = "updateManyLink" href="<?php echo URL . 'admin/updateMany/10'; ?>">Aktualizuj wiele jednocześnie</a>
            </button></p>
        </form>    
    </div>    
</div>
<script>

$("input[type='radio']").on("change",function(){
    var radios = document.getElementsByName("updateMany");
        for(var i=0;i<=radios.length;i++){
            let amount = $("input[type='radio']:checked").val();
            let oldlink = $("#updateManyLink").attr("href");
            oldlink = oldlink.split("/");
            oldlink.pop();
            oldlink.push(amount);
            let newlink = oldlink.join("/");        
            $("#updateManyLink").attr("href",newlink);          
            if(radios[i].checked){                
            }
            break;
        }
});      
</script>
