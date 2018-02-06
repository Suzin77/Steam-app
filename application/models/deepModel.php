<?php

class DeepModel
{
	function __construct($db){
		try {
			$this->db = $db;
		} catch (PDOException $e){
			exit('Nie udało się połączyć z bazą');
		}
	}

	public function echoFromDeep($string){
		echo $string;
	}
}

?>