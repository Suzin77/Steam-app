<?php 
include_once 'application/libs/model.php';

class DataSearchReadModel extends Model
{
	public function getRandomRows($column,$tableName,$limit=1)
	{
		$sql = "SELECT $column FROM $tableName ORDER BY rand() LIMIT $limit";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function getAllUsers()
	{
		$sql = "SELECT user_id,persona_name,avatar FROM users WHERE communityvisibilitystate = 0 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
	
}
?>