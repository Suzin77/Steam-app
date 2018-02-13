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

    public function getCountryCode()
    {
        $sql = "SELECT loccountry_code FROM users WHERE loccountry_code IS NOT NULL";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function countCountries($data, $result=array())
    {
        foreach($data as $key =>$value){
        $result[]= $data[$key]["loccountry_code"];
    }
    $result = array_count_values($result);
    //array_count_values($userCountryCodes['loccountry_code']);
    return $result;
    }

    
}
