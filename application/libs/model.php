<?php
class Model
{

	function __construct($db){
		try {
			$this->db = $db;
		} catch (PDOException $e){
			exit('Nie udało się połączyć z bazą');
		}
	}

	public function loadModel($model_name)
    {
        require 'application/models/' . strtolower($model_name) . '.php';
        // return new model (and pass the database connection to the model)
        return new $model_name($this->db);
    }
}

?>