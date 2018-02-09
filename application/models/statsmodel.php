<?php

class StatsModel
{
    /**
     A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }


    public function getAmountOf($column, $table)
    {
        $sql ="SELECT COUNT($column) AS amount_of FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();
        $response = $query->fetch();
        return $response['amount_of'];
    }
}
