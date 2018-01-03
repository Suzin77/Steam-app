<?php

class SteamUsersModel
{
	// every model need connection to database.

	function __construct($db){
		try {
			$this->db = $db;
		} catch (PDOException $e){
			exit('Nie udało się połączyć z bazą');
		}
	}

	public function getAllUsers()
	{
		$sql = "SELECT user_id,personal_name FROM users";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function deleteUser($user_id)
	{
		$sql = "DELETE FROM users WHERE user_id = :user_id";
		$query = $this->db->prepare($sql);
		$query->execute(array(':user_id'=> $user_id));

	}
}
?>