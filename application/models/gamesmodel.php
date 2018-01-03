<?php

class GamesModel
{
	// every model need connection to database.

	function __construct($db){
		try {
			$this->db = $db;
		} catch (PDOException $e){
			exit('Nie udało się połączyć z bazą');
		}
	}

	public function getAllPlayers()
	{
		$sql = "SELECT user_id,personal_name FROM users";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}
}
?>